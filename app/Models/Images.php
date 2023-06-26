<?php

namespace App\Models;

use App\Models\Images;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Images extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    //per permettere a questo modello di inserire array nel database
    protected $casts = [
        'labels' => 'array'
    ];

    //relazione ONE TO MANY con la tabella degli ANNUNCI
    public function announcement()
    {
        //un immagine apparterrà ad un solo annnuncio
        return $thid->belongsTo(Announcement::class);
    }


    //FUNZIONI per recuperare le IMMAGINI CROPPATE

        //funzione statica 
        public static function getUrlByFilePath($filePath, $w = null, $h = null){

            //se non esistono i valori dell'altezza e della larghezza allora verrà restituita l'immagine originale
            if(!$w && !$h)
            {
                return Storage::url($filePath);
            }

            //altrimenti andremo a recuperare l'immagine croppata
            $path = dirname($filePath);
            $filename = basename($filePath);
            $file = "{$path}/crop_{$w}x{$h}_{$filename}";

            return Storage::url($file);
        }


        //funzione pubblica 
        public function getUrl($w = null, $h = null)
        {
            return Images::getUrlByFilePath($this->path, $w, $h);
        }

    //fine 
    
}

