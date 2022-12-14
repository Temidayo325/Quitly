<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateNewUser
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public static function create(\App\Http\Requests\User\UserRegisterRequest $input)
    {
         $checkRole = \App\Services\checkRole::check($input->email);
         $user =  User::create([
            'name' => $input->name,
            'email' => $input->email,
            'nickname' => $input->nickname,
            'is_admin' => $checkRole[0],
            'institution' => $input->institution,
            'verified' => 0,
            'code' => \App\Services\Utility::generateInteger(),
            'password' => Hash::make($input->password),
         ]);
         $role = \App\Models\Role::whereRole($checkRole[1])->first();
         $user->role()->attach($role);
         return $user;
    }
}
