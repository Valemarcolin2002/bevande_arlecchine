<?php

namespace App\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    //relazione one to many con la tabella degli annunci
    public function announcements()
    {
        //una categoria avrà più annunci
        return $this->hasMany(Announcement::class);
    }
}
