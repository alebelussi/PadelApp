<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    //modificato per garantire l'inserimento della foto profilo
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],
            'phone' => ['required', 'string', 'max:20'],
            'tax_code' => ['required', 'string', 'size:16', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted'] : [],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],
            'birth_date' => $input['birth_date'],
            'gender' => $input['gender'],
            'phone' => $input['phone'],
            'tax_code' => $input['tax_code'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'profile_photo_path' => $input['profile_photo_path'] ?? null, // aggiungi questa riga
        ]);

        $user->assignRole('user');

        return $user;
    }


    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<string>
     */
    protected function passwordRules()
    {
        return ['required', 'string', 'min:8', 'confirmed'];
    }
}