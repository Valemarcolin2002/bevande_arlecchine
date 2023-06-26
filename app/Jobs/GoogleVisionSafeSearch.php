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

class GoogleVisionSafeSearch implements ShouldQueue
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

        //se l'immagine non viene trovata viene eseguito un retar ponendo fine all'esecuzione di questo job
        if(!$i)
        {
            return;
        }

        //recuperiamo il file e successivamente il path dell'immagine
        $image = file_get_contents(storage_path('app/public/' . $i->path));

        //inseriamo all'interno del file .env le variabili d'ambiente che conterranno le credenziali per accedere al servizio google (GOOGLE_APPLICATION_CREDENTIALS)
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        //creiamo il collegamento con google vision
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->safeSearchDetection($image);
        $imageAnnotator->close();

        //recuperiamo la response getSafeSearchAnnotation che conterra i dati (adult, medical, spoof, violence, racy) con i relativi valori (Unknow, Very Unlikely, Unlikely, Possible, Likely, Very Likely)
        $safe = $response->getSafeSearchAnnotation();

        //salviamo ogni valore all'interno della variabile relativa al dato a cui e associato il valore (i valori vanno da 0 a 5)
        $adult = $safe->getAdult();
        $medical = $safe->getMedical();
        $spoof = $safe->getSpoof();
        $violence = $safe->getViolence();
        $racy = $safe->getRacy();

        //creiamo un array che funzionera come dizionrio per identificare la classe aggiunta e creare una specie di semaforo per identificare i valori
        $likelihoodName = ['text-secondary fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle', 'text-warning fas fa-circle', 'text-warning fas fa-circle', 'text-danger fas fa-circle',];

        //salviamo ogni etichetta del semaforo (grigio, verde, giallo e rosso) all'interno di ogni campo 
        $i->adult = $likelihoodName[$adult];
        $i->medical = $likelihoodName[$medical];
        $i->spoof = $likelihoodName[$spoof];
        $i->violence = $likelihoodName[$violence];
        $i->racy = $likelihoodName[$racy];

        //salviamo i valori all'interno del database
        $i->save();
    }
}
