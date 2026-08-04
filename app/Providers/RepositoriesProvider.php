<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Contracts\CronologiaRepositoryContract;
use Src\Procesos\Infraestructure\Repositories\CronologiaRepository;


class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CronologiaRepositoryContract::class, fn () => new CronologiaRepository);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
