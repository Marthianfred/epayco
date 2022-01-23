<?php

namespace App\Providers;

use App\Entities\Clientes;
use App\Repositories\ClientesRepository;
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
        $this->app->bind(ClientesRepository::class, function ($app){
            return new ClientesRepository(
                $app['em'],
                $app['em']->getclassMetaData(Clientes::class)
            );
        });
        //
    }
}
