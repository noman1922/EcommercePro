<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // Explicitly log out the user after registration to force them to login
        Auth::logout();

        return redirect()->route('login')->with('status', 'Registration successful! Please log in to continue.');
    }
}
