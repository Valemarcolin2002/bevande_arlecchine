<?php

namespace App\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    //relazione ONE TO MANY con la tabella degli ANNUNCI
    public function announcements()
    {
        //una categoria potrà avere più annunci
        return $this->hasMany(Announcement::class);
    }
}
