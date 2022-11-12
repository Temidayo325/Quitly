<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\UserRegisteredEmails;

class UserController extends Controller
{
     public function register(\App\Http\Requests\User\UserRegisterRequest $request)
     {
          $newUser = \App\Actions\CreateNewUser::create($request);
          UserRegisteredEmails::dispatch($newUser);
          return response()->json([
               'email' => $newUser->email,
               'name' => $newUser->name,
               'verificationCode' => $newUser->code,
               'status' => true,
               'statusCode' => 201
          ]);
     }
     
     public function adminLogin(\App\Http\Requests\User\UserLoginRequest $request)
     {
               $user = \App\Models\User::select('id', 'email', 'name', 'institution','nickname', 'verified')->where('email', $request->email)->first();
                if ($user->verified != 1)
                {
                     // send verification code to email address
                    \App\Jobs\SendRecoveryEmail::dispatch($user);
                    // $request->session()->put('email', $request->email);
                    return response()->json([
                         'status' => false,
                         'statusCode' => 303,
                         'message' => "Account not verified"
                    ]);
                }
                // check if the password is correct and Authenticate user
                if ( ! \Illuminate\Support\Facades\Auth::attempt(['email' => $request->email, 'password' => $request->password]) && $user->is_admin != 0) {
                     return response()->json([
                          'status' => false,
                          'statusCode' => 422,
                          'message' => "Invalid input given, ensure your password and email are correct"
                     ]);
                }
                return response()->json([
                     'token' => $user->createToken('auth_token_for_user')->plainTextToken,
                     'message' => "User successfully logged in",
                     'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK,
                     'user' => $user,
                     'topics' => \App\Models\Topic::all(),
                     'questions' => \App\Models\Question::whereStatus(0)->oldest()->limit(100)->get()
                ]);
     }

     public function login(\App\Http\Requests\User\UserLoginRequest $request)
     {
               $user = \App\Models\User::select('id', 'email', 'name', 'institution','nickname', 'verified')->where('email', $request->email)->first();
                if ($user->verified != 1)
                {
                     // send verification code to email address
                    \App\Jobs\SendRecoveryEmail::dispatch($user);
                    // $request->session()->put('email', $request->email);
                    return response()->json([
                         'status' => false,
                         'statusCode' => 303,
                         'message' => "Account not verified"
                    ]);
                }
                // check if the password is correct and Authenticate user
                if ( ! \Illuminate\Support\Facades\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                     return response()->json([
                          'status' => false,
                          'statusCode' => 422,
                          'message' => "Invalid input given, ensure your password and email are correct"
                     ]);
                }
                $results = \App\Models\Result::where('user_id', $user->id)->latest()->get()->map(function($item){
                          return [
                                'score' => $item->score,
                                'topic' => \App\Models\Topic::select('title')->whereId($item->topic_id)->first(),
                                 'date' => \Carbon\Carbon::parse($item->created_at)->diffForHumans(),
                                 'grade' => \App\Models\Grade::whereId($item->grade_id)->first()->grade,
                                 'opinion' => \App\Models\Grade::whereId($item->grade_id)->first()->term
                              ];
                      });
                $topics = \App\Models\Topic::latest()->get();
                return response()->json([
                     'token' => $user->createToken('auth_token_for_user')->plainTextToken,
                     'message' => "User successfully logged in",
                     'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK,
                     'user' => $user,
                     'countedResult' => count($results),
                     'results' => $results->take(3),
                     'countTopics' => $topics->count(),
                     'topics' => $topics,
                     'top3' => $topics->take(3)
                ]);
     }

     public function verifyEmail(\App\Http\Requests\User\ValidateEmailRequest $request)
     {
          $user = \App\Models\User::select('id', 'email', 'name', 'verified')->where('email', $request->email)->first();
          $user->verified = 1;
          $user->save();

          return response()->json([
               'status' => true,
               'message' => "User successfully logged in",
               'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK,
               'user' => $user
          ]);
     }

     public function resendEmailVerification()
     {
          $user = \App\Models\User::select('id', 'email', 'name', 'institution','nickname', 'verified')->where('email', $request->email)->first();
          \App\Jobs\SendRecoveryEmail::dispatch($user);
          return response()->json([
               'status' => true,
               'message' => "Verification email resent",
               'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK
          ]);
     }

     public function logout(\App\Http\Requests\User\UserIdRequest $request)
     {
          $user = \App\Models\User::whereId($request->user_id)->first();
          $user->tokens()->delete();
          return response()->json([
               'status' => true,
               'message' => "You have been logged out from your account",
               'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK
          ]);
     }

     public function resetPassword(\App\Http\Requests\User\PasswordResetRequest $request)
     {
          $user = \App\Models\User::select('password', 'id')->where('email', $request->email)->first();
          $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
          $user->save();

          // \Illuminate\Support\Facades\Mail::to($request->email)->queue( new \App\Mail\PasswordChanged());
          return response()->json([
              'status' => true,
              'message' => "Password changed",
              'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK
         ]);
     }

     public function changePassword(\App\Http\Requests\User\PasswordResetRequest $request)
     {
            // Change the hashed password
            $user = \App\Models\User::select('password', 'id')->where('email', auth()->user()->email)->first();
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password1);
            $user->save();

            // \Illuminate\Support\Facades\Mail::to($request->email)->queue( new \App\Mail\PasswordChanged());
            return response()->json([
                'status' => true,
                'message' => "Password changed",
                'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK
           ]);
     }
     
     public function myResults(\App\Http\Requests\User\UserIdRequest $request)
     {
          return response()->json([
              'status' => true,
              'message' => "Result retrieved successfully",
              'statusCode' =>  \Symfony\Component\HttpFoundation\Response::HTTP_OK,
              'results' => \App\Models\Result::where('user_id', $request->user_id)->latest()->limit(15)->get()->map(function($item){
                  return [
                        'score' => $item->score,
                        'topic' => \App\Models\Topic::select('title')->whereId($item->topic_id)->first(),
                         'date' => \Carbon\Carbon::parse($item->created_at)->diffForHumans()
                      ];
              })
         ], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
     }
}
