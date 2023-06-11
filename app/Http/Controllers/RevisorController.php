<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    //per permettere all'utente di richiedere di diventare revisore
    public function becomeRevisor()
    {
        Mail::to('tigrevalescorpione@gmail.com')->send(new BecomeRevisor(Auth::user()));
        return redirect()->back()->with('message', 'complimenti! hai richiesto di diventare revisore correttamente');
    }

    //per permettere all'aministratore del sito di rendere un utente revisore
    public function makeRevisor(User $user)
    {
        Artisan::call('bevande_arlecchine:makeUserRevisor', ["email"=>$user->email]);
        return redirect('/')->with('message', 'Complimenti! l\'utente è diventato revisore');
    }

    //per tornare la vista dove il revisore può controllare gli annunci
    public function index()
    {
        $announcement_to_check = Announcement::where('is_accepted', null)->first();
        return view('revisor.index', compact('announcement_to_check'));
    }

    //per accettare un annuncio
    public function acceptAnnouncement(Announcement $announcement)
    {
        $announcement->setAccepted(true);
        return redirect()->back()->with('message', 'Complimenti, hai accettato l\'annuncio');
    }

    //per rifiutare un annuncio
    public function rejectAnnouncement(Announcement $announcement)
    {
        $announcement->setAccepted(false);
        return redirect()->back()->with('message', 'Complimenti, hai rifiutato l\'annuncio');
    }
}
