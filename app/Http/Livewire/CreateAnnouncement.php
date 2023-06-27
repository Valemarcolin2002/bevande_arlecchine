<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class CreateAnnouncement extends Component
{
    //da la possibilità al componente di aggiungere file multimediali
    use WithFileUploads;

    //DICHIARAZIONI delle VARIABILI
        //variabili generali
        public $message;
        public $validated;
        public $announcement;

        //variabili dei campi dell'annuncio
        public $title;
        public $body;
        public $price;
        public $category;
        
        //variabili per le immagini
        public $temporary_images;
        public $images = [];
        public $image;
    //fine dichiarazioni variabili


    //regole che devono rispettare gli input
    protected $rules = [
        'title' => 'required|min:4',
        'body' => 'required|min:8',
        'price' => 'required|numeric',
        'category' => 'required',
        'images.*' =>'image|max:2048',
        'temporary_images.'=>'image|max:2048',
    ];


    //messaggi di errore che appariranno nel caso in cui le regole non vengono rispettate
    protected $messages =[
        'required' => 'il campo :attribute è richiesto',
        'title.min' => 'il campo :attribute è troppo corto, deve essere lungo almeno 4 caratteri',
        'body.min' => 'il campo :attribute è troppo corto, deve essere lungo almeno 8 caratteri',
        'numeric' => 'il campo :attribute deve essere un numero',
        'images.image' => 'L\'immagine dev\'essere un\'immagine',
        'images.max' => 'L\'immagine deve pesare al massimo 2mb',
        'temporary_images.*.image' => 'i file devono essere immagini',
        'temporary_images.*.max' => 'L\'immagine deve pesare al massimo 2mb',
        
    ];


    //funzione per INSERIRE un IMMAGINE nell'ANTEPRIMA
    public function updatedTemporaryImages()
    {
        if($this->validate(['temporary_images.*'=>'image|max:2048',]))
        {
            foreach ($this->temporary_images as $image)
            {
                $this->images[] = $image;
            }
        }
    }


    //funzione per RIMUOVERE un IMMAGINE dall'ANTEPRIMA
    public function removeImage($key)
    { 
        if (in_array($key, array_keys($this->images)))
        {
            unset($this->images[$key]);
        }
    }


    //funzione per SALVARE l'ARTICOLO
    public function store()
    {
        //per verificare che tutte le regole vengano rispettate
        $this->validate();

        //per collegare ad ogni annuncio la categoria scelta dall'utente
        $category=Category::find($this->category);

        //per creare l'annuncio con la categoria collegata
        $announcement = $category->announcements()->create(
            [
                //campi dell'articolo (esclusa la categoria)
                'title'=>$this->title,
                'body'=>$this->body,
                'price'=>$this->price,
            ]
        );

        //per collegare l'immagine all'annuncio
        if(count($this->images))
        {
            foreach($this->images as $image)
            {
                //destinazione dove verrà salvata l'immagine
                $newFileName = "announcements/{$announcement->id}";
                //creiamo una nuova cartella announcement con all'interno una cartella con l'id dell'annuncio, ogni annuncio avrà le proprie immagini con il resize all'interno di questa cartella
                $newImage = $announcement->images()->create(['path'=>$image->store($newFileName,'public')]);

                //catena dei job con prima operazione quella di sostituire i volti delle persone tramite il job RemoveFaces
                RemoveFaces::withChain([
                    //avviamo il job ResizeImage in asincrono, che andrà a croppare l'immagine in background e la salverà nella cartella announcements tramite l'id
                    new ResizeImage($newImage->path , 400 , 300),
                    //avviamo il job GoogleVisionSafeSearch, che andrà ad analizzare l'immagine 
                    new GoogleVisionSafeSearch($newImage->id),
                    //avviamo il job GoogleVisionLabelImage, che andrà a calcolare il contenuto delle immagini
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);

            }

            //per cancellare la cartella automatica e temporanea di livewire
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        //per collegare l'utente all'annuncio 
        Auth::user()->announcements()->save($announcement);

        //MESSAGGIO: ANNUNCIO CREATO CORRETTAMENTE
        session()->flash('message', 'DRINK creato con successo, sarà pubblicato dopo la revisione');
        //richiamo della funzione per liberare i campi del form
        $this->cleanForm();
    }


    //funzione per la validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    //funzione per SVUOTARE i CAMPI del form per creare gli annunci
    public function cleanForm()
    {
        $this->title='';
        $this->body='';
        $this->price='';
        $this->category='';
        $this->image='';
        $this->images=[];
        $this->temporary_images=[];
    } 


    //funzione per TORNARE la VISTA
    public function render()
    {
        return view('livewire.create-announcement');
    }
}
