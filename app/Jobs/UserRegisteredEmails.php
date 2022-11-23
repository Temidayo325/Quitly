<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class UserRegisteredEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
            $this->user = (object) $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            // $code = \App\Services\Utility::generateInteger();
            // $user = \App\Models\User::select('code', 'id')->where('email', $this->user->email)->first();
            // $user->code = $code;
            // $user->save();
           Mail::to($this->user->email)->send(new \App\Mail\VerifyUser($this->user->code));
           Mail::to($this->user->email)->send(new \App\Mail\WelcomeUser($this->user->name));
    }

    public function failed(\Throwable $e)
    {
         info($e->getMessage());
    }
}
