<?php

namespace App\Models;

use App\Models\User;
use App\Models\Images;
use App\Models\Category;
use App\Models\Announcement;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Announcement extends Model
{
    use HasFactory, Searchable;
    protected $fillable = ['title', 'body', 'price',];

    //funzione per rendere gli ANNUNCI CERCABILI 
    /**
     * Get the indexable data array for the model.
     * 
     * @return array
     */
    public function toSearchableArray()
    {
        $category = $this->category;
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'category' => $category,
        ];

        return $array;
    }

    //relazione ONE TO MANY con la tabella delle IMMAGINI
    public function images()
    {
        //un annuncio potrà avere più immagini
        return $this->hasMany(Images::class);
    }

    //relazione ONE TO MANY con la tabella delle CATEGORIE
    public function category()
    {
        //un annuncio apparterrà ad una sola categoria
        return $this->belongsTo(Category::class);
    }

    //relazione ONE TO MANY con la tabella degli UTENTI
    public function user()
    {
        //un annuncio apparterrà ad un solo utente 
        return $this->belongsTo(User::class);
    }

    //funzione per modificafre il campo is_accepted da null a true o false
    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    //funzione per contare gli annunci non ancora accettati o rifiutati dall'utente revisore
    public static function toBeRevisionedCount()
    {
        return Announcement::where('is_accepted', null)->count();
    }

}
