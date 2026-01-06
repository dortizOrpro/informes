<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Caja\Domain\Contracts\CobranzasRepositoryContract;
use Src\Caja\Domain\Contracts\DocumentosRepositoryContract;
use Src\Caja\Domain\Contracts\PagosRepositoryContract;
use Src\Caja\Domain\Contracts\PreingresoRepositoryContract;
use Src\Caja\Infrastructure\Repositories\CobranzasRepository;
use Src\Caja\Infrastructure\Repositories\DocumentosRepository;
use Src\Caja\Infrastructure\Repositories\PagosRepository;
use Src\Caja\Infrastructure\Repositories\PreingresoRepository;
use Src\Calculo\Domain\Contracts\IndicadoresRepositoryContract;
use Src\Calculo\Infrastructure\Repositories\IndicadoresRepository;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(IndicadoresRepositoryContract::class, fn () => new IndicadoresRepository);
        $this->app->singleton(CobranzasRepositoryContract::class, fn () => new CobranzasRepository);
        $this->app->singleton(DocumentosRepositoryContract::class, fn () => new DocumentosRepository);
        $this->app->singleton(PreingresoRepositoryContract::class, fn () => new PreingresoRepository);
        $this->app->singleton(PagosRepositoryContract::class, fn () => new PagosRepository);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
