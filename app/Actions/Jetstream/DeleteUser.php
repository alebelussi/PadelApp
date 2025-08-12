<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    public function delete(User $user): void
    {
        // Elimina la foto profilo se presente
        $user->deleteProfilePhoto();

        // Revoca tutti i token API (per Laravel Sanctum)
        $user->tokens->each->delete();

        // Elimina l'utente
        $user->delete();
    }
}

