<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'documento_identificacion' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255',],
            'telefono' => ['required', 'string', 'max:10', 'min:7'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'documento_identificacion' => $input['documento_identificacion'],
            'name' => $input['name'],
            'apellidos' => $input['apellidos'],
            'telefono' => $input['telefono'],
            'email' => $input['email'],
            'sede_id' => $input['sede'],
            'password' => Hash::make($input['password']),
        ])->assignRole('Innovador');
    }
}
