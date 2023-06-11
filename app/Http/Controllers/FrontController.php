<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //HOME
    public function welcome()
    {
        //per passare gli ultimi 6 annunci nella pagina home
        $announcements = Announcement::where('is_accepted', true)->take(6)->get()->sortByDesc('created_at');

        //riporta alla vista home
        return view('welcome', compact('announcements'));
    }

    //DETTAGLIO CATEGORIE
    public function categoryShow(Category $category)
    {

        //riporta alla vista del dettaglio delle categorie
        return view('categoryShow', compact('category'));
    }

}


