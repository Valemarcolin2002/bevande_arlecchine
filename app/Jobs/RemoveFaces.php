<?php

namespace App\Jobs;

use App\Models\Images;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class RemoveFaces implements ShouldQueue
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

        //recuperiamo il srcPath dell'immagine
        $srcPath = storage_path('app/public/'. $i->path);
        $image = file_get_contents($srcPath);

        //inseriamo all'interno del file .env le variabili d'ambiente che conterranno le credenziali per accedere al servizio google (GOOGLE_APPLICATION_CREDENTIALS)
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        //tracciamo il volto delle persone
        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->faceDetection($image);
        $faces = $response->getFaceAnnotations();

        //per ogni volto che l'intelligienza di google ha trovato applichiamo un watermark
        foreach($faces as $face)
        {
            //troviamo i vertici del volto
            $vertices = $face->getBoundingPoly()->getVertices();

            //per ogni angolo avremo un array con all'interno 4 array con la posizione sull'asse x e sull'asse y
            $bounds = [];
            foreach ($vertices as $vertex)
            {
                //prendiamo gli angoli sull'asse x e sull'asse y
                $bounds[] = [$vertex->getX(), $vertex->getY()];
            }

            //recuperiamo le larghezze e le altezze dei volti tramite gli angoli
            $w = $bounds[2][0] - $bounds[0][0];
            $h = $bounds[2][1] - $bounds[0][1];

            //aggiungiamo l'immagine che andrà a coprire il volto
            $image = SpatieImage::load($srcPath);

            //modifichiamo l'immagine aggiungendo un immagine che andrà a coprire i volti delle persone
            $image->watermark(base_path('resources/img/Emoji_1605971305.png'))
                ->watermarkPosition('top-left')
                ->watermarkPadding($bounds[0][0], $bounds[0][1])
                ->watermarkWidth($w, Manipulations::UNIT_PIXELS)
                ->watermarkHeight($h, Manipulations::UNIT_PIXELS)
                ->watermarkFit(Manipulations::FIT_STRETCH);

            //salviamo l'immagine modificata
            $image->save($srcPath);
        }

        //chiudiamo il collegamento con google
        $imageAnnotator->close();
    }
}
