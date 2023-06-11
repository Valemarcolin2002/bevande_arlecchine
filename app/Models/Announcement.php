<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'price',];

    //relazione one to many con la tabella delle categorie
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
