<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    //torna la vista per visualizzare tutti gli annunci
    public function indexAnnouncement()
    {
        //per passare tutti gli annunci
        $announcements = Announcement::where('is_accepted', true)->paginate(6); 
        //per tornare la vista
        return view('announcements.index', compact('announcements'));
    }

    //torna la vista per visualizzare il dettaglio dell'annuncio
    public function showAnnouncement(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    //torna la vista per la creazione degli annunci
    public function createAnnouncement()
    {
        return view('announcements.create');
    }

    //torna la vista con gli annunci cercati
    public function searchAnnouncements(Request $request)
    {
        //per passare solo gli annunci cercatu
        $announcements = Announcement::search($request->searched)->where('is_accepted', true)->paginate(6);

        return view('announcements.index', compact('announcements'));
    }
}


