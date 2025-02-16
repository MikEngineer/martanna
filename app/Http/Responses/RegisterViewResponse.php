<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterViewResponse;

class RegisterViewResponse implements RegisterViewResponse
{
    public function toResponse($request)
    {
        return view('auth.register');
    }
}
