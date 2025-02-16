<?php

use App\Providers\FortifyServiceProvider;
use Illuminate\Foundation\Providers\ComposerServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    FortifyServiceProvider::class,
    Livewire\LivewireServiceProvider::class,
];
