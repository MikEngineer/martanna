<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;

class CustomLoginViewResponse implements LoginViewResponseContract
{
    public function toResponse($request)
    {
        return view('auth.login');
    }
}
