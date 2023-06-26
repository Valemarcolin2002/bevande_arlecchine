<?php

namespace App\Jobs;

use App\Models\Images;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionLabelImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $announcement_image_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($announcement_image_id)
    {
        $this->announcement_image_id = $announcement_image_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //recuperiamo l'id dell'immagine nel database
        $i = Images::find($this->announcement_image_id);

        //se l'immagine non viene trovata viene eseguito un return ponendo fine all'esecuzione del job
        if(!$i)
        {
            return;
        }

        //recuperiamo il file e successivamente il path dell'immagine
        $image = file_get_contents(storage_path('app/public/' . $i->path));

        //inseriamo all'interno del file .env le variabili d'ambiente che conterranno le credenziali per accedere al servizio google (GOOGLE_APPLICATION_CREDENTIALS)
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        //richiediamo di trovare il contenuto dell'immagine e di avere queste informazioni
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->labelDetection($image);
        $labels = $response->getLabelAnnotations();

        //se ci sono delle labels (il contenuto delle immagini), allora per ogni immagine andremo ad aggiungere, all'interno dell'arry vuoto $result, la descrizione della label
        if($labels) 
        {
            $result = [];
            foreach ($labels as $label)
            {
                $result[] = $label->getDescription();
            }
            
            //una volta presa la descrizione della label salviamo nel database all'interno del campo labels l'array $result
            $i->labels = $result;
            $i->save();
        }

        $imageAnnotator->close();
    }
}
