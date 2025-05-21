<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    // Custom Code, Redirecting to login page after logout
    public function toResponse($request)
    {
        return redirect('/login');
    }
}