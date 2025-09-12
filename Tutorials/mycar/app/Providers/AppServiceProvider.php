<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
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
        Blade::if('admin', function(){
            if(Auth::check()){
                return Auth::user()->email == 'admin@admin.com';
            }
            return false;
        });

        if(env('APP_ENV') !== 'local'){
            URL::forceScheme('https');
        }
    }
}
