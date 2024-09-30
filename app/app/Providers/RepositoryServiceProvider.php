<?php

namespace App\Providers;

use App\Interfaces\EventRepositoryInterface;
use App\Interfaces\InscriptionRepositoryInterface;
use App\Repositories\EventRepository;
use App\Repositories\InscriptionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(InscriptionRepositoryInterface::class, InscriptionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
