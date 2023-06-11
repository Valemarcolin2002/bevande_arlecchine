<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//HOME
Route::get('/', [FrontController::class, 'welcome'])->name('welcome');

//DETTAGLIO CATEGORIA (mostra gli annunci di una categoria)
Route::get('/categoria/{category}', [FrontController::class, 'categoryShow'])->name('categoryShow');


//ANNUNCIO

    //TUTTI gli ANNUNCI
    Route::get('/tutti/annunci', [AnnouncementController::class, 'indexAnnouncement'])->name('announcements.index');

    //DETTAGLIO ANNUNCIO
    Route::get('/dettaglio/annuncio/{announcement}', [AnnouncementController::class, 'showAnnouncement'])->middleware('auth')->name('announcements.show');

    //CREA ANNUNCIO
    Route::get('/nuovo/annuncio',[AnnouncementController::class, 'createAnnouncement'])->middleware('auth')->name('announcements.create');
        
//fine anuncio

//REVISORE

    //RICHIESTA per DIVENTARE REVISORE
    Route::get('/richiesta/revisore', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');

    //per RENDERE un UTENTE REVISORE
    Route::get('/rendi/revisore/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

    //SEZIONE REVISORE (pagina in cui il revisore accetta o rifiuta gli annunic)
    Route::get('/revisor/home', [RevisorController::class, 'index'])->middleware('IsRevisor')->name('revisor.index');

    //ACCETTA ANNUNCIO
    Route::patch('/accetta/annuncio/{announcement}', [RevisorController::class, 'AcceptAnnouncement'])->middleware('IsRevisor')->name('revisor.accept_announcement');

    //RIFIUTA ANNUNCIO
    Route::patch('/rifiuta/annuncio/{announcement}', [RevisorController::class, 'rejectAnnouncement'])->middleware('IsRevisor')->name('revisor.reject_announcement');

//fine revisore

