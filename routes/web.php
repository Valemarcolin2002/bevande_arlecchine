<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
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
    Route::get('/tutti/annunci', [AnnouncementController::class, 'indexAnnouncement'])->middleware('auth')->name('announcements.index');

    //DETTAGLIO ANNUNCIO
    Route::get('/dettaglio/annuncio/{announcement}', [AnnouncementController::class, 'showAnnouncement'])->middleware('auth')->name('announcements.show');

    //CREA ANNUNCIO
    Route::get('/nuovo/annuncio',[AnnouncementController::class, 'createAnnouncement'])->middleware('auth')->name('announcements.create');
        

