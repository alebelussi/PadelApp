<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class CustomRegisteredUserController
{
    public function store(Request $request)
    {
        $input = $request->all();

        // Se è presente la foto, salva e metti il path nell'array input
        if ($request->hasFile('photo')) {
            $input['profile_photo_path'] = $request->file('photo')->store('profile-photos', 'public');
        }

        // Valida e crea l'utente tramite la action Fortify
        $creator = app(CreateNewUser::class);

        try {
            $user = $creator->create($input);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        //login in automatico
        Auth::login($user);

        //reindirizza alla homepage
        return redirect('/');
    }
}

