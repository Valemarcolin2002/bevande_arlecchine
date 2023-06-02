<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    //funzione per tornare la vista per la creazione degli annunci
    public function createAnnouncement()
    {
        return view('announcements.create');
    }
}
