<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class CreateAnnouncement extends Component
{
    public $title;
    public $body;
    public $price;
    public $category;

    //regole che devono rispettare gli input
    protected $rules = [
        'title' => 'required|min:4',
        'body' => 'required|min:8',
        'price' => 'required|numeric',
        'category' => 'required',

    ];

    //messaggi di errore che appariranno nel caso in cui le regole non vengono rispettate
    protected $messages =[
        'required' => 'il campo :attributo è richiesto',
        'min' => 'il campo :attributo è troppo corto',
        'numeric' => 'il campo :attributo deve essere un numero',
    ];

    //funzione per SALVARE l'ARTICOLO
    public function store()
    {
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

        //per collegare l'utente all'annuncio 
        Auth::user()->announcements()->save($announcement);

        //MESSAGGIO: ANNUNCIO CREATO CORRETTAMENTE
        session()->flash('message', 'DRINK creato con successo');
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
    } 

    //funzione per TORNARE la VISTA
    public function render()
    {
        return view('livewire.create-announcement',
        //per passare le categorie alla vista create-announcement.blade.php
            [
                'categories'=>Category::all()
            ]
        );
    }
}
