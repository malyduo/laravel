<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Client;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
        view()->composer('layouts.panel.dashboard', function($view) {
            $clients = Client::all();
            $client = Client::find(Auth::user()->id_client);
            
            $data = [
                'client' => $client,
                'clients' => $clients,
            ];
            
            $view->with($data);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
