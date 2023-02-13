<?php

namespace App\Actions\Accommodations;

use App\Models\Accommodation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class CreateNewAccommodation
{
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ])->validate();

        return Accommodation::create([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);
    }
}
