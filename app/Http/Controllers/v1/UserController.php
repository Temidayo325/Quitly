<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\UserRegisteredEmails;

class UserController extends Controller
{
     public function register(\App\Http\Requests\UserLoginRequest $request)
     {
          $newUser = \App\Actions\CreateNewUser::create($request);
          UserRegisteredEmails::dispatch($newUser);
          return response()->json([
               'email' => $newUser->email,
               'name' => $newUser->name,
               'verificationCode' => \App\Services\Utility::generateInteger(),
               'status' => true,
               'statusCode' => 201
          ]);
     }

     public function login(){}
     public function verifyEmail(){}
     public function resendEmailVerification(){}

}
