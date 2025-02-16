<?php

namespace App\Providers;

use Livewire\Livewire;
use Livewire\Component;
use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\CalendarComponent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Registra manualmente il componente Livewire
        Livewire::component('calendar-component', CalendarComponent::class);

        // Registra manualmente la macro "emit" se non esiste
        if (! method_exists(Component::class, 'emit')) {
            Component::macro('emit', function ($event, ...$params) {
                // Questa è una semplice implementazione che logga l'evento.
                // **ATTENZIONE:** Questo non replica la funzionalità completa di Livewire!
                logger()->info("Event emitted: " . $event, $params);
                return $this;
            });
        }
    }
}
