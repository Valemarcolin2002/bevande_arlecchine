<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
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
        return $this->belongsTo(User::class);
    }

}
