<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind per il contratto LoginViewResponse:
        $this->app->singleton(LoginViewResponse::class, function ($app) {
            return new class implements LoginViewResponse {
                public function toResponse($request)
                {
                    return view('auth.login');
                }
            };
        });

        // Bind per il contratto RegisterViewResponse:
        $this->app->singleton(RegisterViewResponse::class, function ($app) {
            return new class implements RegisterViewResponse {
                public function toResponse($request)
                {
                    return view('auth.register');
                }
            };
        });
    }

    public function boot()
    {
        // Puoi definire anche le view in questo modo (opzionale, dato che abbiamo già bindato i contratti):
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });
    }
}



// namespace App\Providers;

// use App\Actions\Fortify\CreateNewUser;
// use App\Actions\Fortify\ResetUserPassword;
// use App\Actions\Fortify\UpdateUserPassword;
// use App\Actions\Fortify\UpdateUserProfileInformation;
// use Illuminate\Cache\RateLimiting\Limit;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\RateLimiter;
// use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Str;
// use Laravel\Fortify\Fortify;

// class FortifyServiceProvider extends ServiceProvider
// {
//     /**
//      * Register any application services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap any application services.
//      */
//     public function boot(): void
//     {
//         Fortify::createUsersUsing(CreateNewUser::class);
//         Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
//         Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
//         Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

//         RateLimiter::for('login', function (Request $request) {
//             $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

//             return Limit::perMinute(5)->by($throttleKey);
//         });

//         RateLimiter::for('two-factor', function (Request $request) {
//             return Limit::perMinute(5)->by($request->session()->get('login.id'));
//         });
//     }
// }
