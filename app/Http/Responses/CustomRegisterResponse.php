<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Http\JsonResponse;

class CustomRegisterResponse implements RegisterResponse
{

    public function toResponse($request)
    {
        //se òa richiesta è ajax
        if ($request->wantsJson()) {
            return new JsonResponse(['two_factor' => false], 201);
        }

        //reindirizzo alla homepage
        return redirect('/');
    }
}
