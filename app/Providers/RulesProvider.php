<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Src\Shared\Rules\DiaHabil;
use Src\Shared\Rules\Rit;
use Src\Shared\Rules\Rut;

class RulesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('dia_habil', DiaHabil::class);
        Validator::extend('rut', Rut::class);
        Validator::extend('rit', Rit::class);
    }
}
