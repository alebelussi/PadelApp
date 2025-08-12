<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    //modifica il reindirizzamento dopo il login
    public function toResponse($request)
    {
        //reindirizza alla homepage dopo il login
        return redirect()->intended('/');
    }
}
