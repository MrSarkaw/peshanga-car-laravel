<?php

namespace App\Providers;
use App\main_menuses;
use App\companies;
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
        view()->composer('layouts.public', function( $view )
            {
               
                $nameOfComp=companies::all();
                $view->with(['nameOfComp'=>$nameOfComp] );
            } );
    }
}
