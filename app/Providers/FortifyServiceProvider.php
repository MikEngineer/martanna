<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use App\Http\Responses\CustomLoginViewResponse;
use App\Http\Responses\CustomRegisterViewResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(LoginViewResponse::class, function ($app) {
            return new CustomLoginViewResponse();
        });

        $this->app->singleton(RegisterViewResponse::class, function ($app) {
            return new CustomRegisterViewResponse();
        });
    }

    public function boot()
    {
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });
    }
}
