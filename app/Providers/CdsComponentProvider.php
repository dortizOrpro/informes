<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Event;
use SocialiteProviders\Manager\SocialiteWasCalled;
use Src\Shared\UserInterface\Components\FileUpload;
use SocialiteProviders\Keycloak\Provider;

class CdsComponentProvider extends ServiceProvider
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
        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('keycloak', Provider::class);
        });

        $this->loadViewsFrom(app_path('../src/Shared/UserInterface/Components/views'), 'cds');
        $this->loadViewsFrom(app_path('../src/Caja/Infrastructure/Presentation'), 'caja');
        Blade::componentNamespace('Src\\Shared\\UserInterface\\Components', 'cds');
        Livewire::component('cds::file-upload', FileUpload::class);
    }
}
