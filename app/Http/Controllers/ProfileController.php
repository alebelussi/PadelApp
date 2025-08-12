<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //elimina l'account
    public function destroy(Request $request, DeletesUsers $deleter)
    {
        // Validazione password inserita
        $request->validate([
            'current_password' => ['required'],
        ]);

        $user = $request->user();

        // Controllo password
        if (! Hash::check($request->input('current_password'), $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => __('La password inserita non è corretta.'),
            ]);
        }

        // Disconnetti l'utente prima di eliminarlo
        Auth::logout();

        // Elimina utente con Jetstream
        $deleter->delete($user);

        // Invalida la sessione
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect alla home
        return redirect('/')->with('status', 'Account eliminato con successo.');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        // Validazione campi, foto è nullable (puoi non caricarla)
        $request->validate([
            'photo' => ['nullable', 'image', 'max:10240'], // foto opzionale
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'tax_code' => ['required', 'string', 'max:16'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        if ($request->hasFile('photo')) {
            // Carico e aggiorno solo se c’è un file valido
            if (method_exists($user, 'updateProfilePhoto')) {
                $user->updateProfilePhoto($request->file('photo'));
            } else {
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
                $path = $request->file('photo')->store('profile-photos', 'public');
                $user->profile_photo_path = $path;
            }
        }
        
        // Aggiorna gli altri campi comunque
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->birth_date = $request->input('birth_date');
        $user->tax_code = $request->input('tax_code');
        $user->phone = $request->input('phone');

        $user->save();

        return back()->with('status', 'profile-updated');
    }

}
