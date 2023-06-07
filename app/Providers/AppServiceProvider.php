<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        //per passare le categorie a tutto il progetto
        if(Schema::hasTable('categories'))
        {
            View::share('categories', Category::all());
        };

        //per aggiustare il codice per l'impaginazione
        Paginator::useBootstrap();
        
    }
}
