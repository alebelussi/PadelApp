<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'tax_code' => ['nullable', 'string', 'max:16'],
            'phone' => ['nullable', 'string', 'max:20'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // Aggiorna i dati senza toccare l'email
        $user->forceFill([
            'name' => $input['name'],
            'surname' => $input['surname'] ?? $user->surname,
            'birth_date' => $input['birth_date'] ?? $user->birth_date,
            'tax_code' => $input['tax_code'] ?? $user->tax_code,
            'phone' => $input['phone'] ?? $user->phone,
        ])->save();
    }
}
