<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    //metodo per aggiornare la password
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La password corrente non è corretta']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        //mi mantengo loggato
        Auth::login($user);
        $request->session()->regenerate();
        
        return redirect()->route('profile.show')->with('status', 'Password aggiornata con successo!');
    }
}

