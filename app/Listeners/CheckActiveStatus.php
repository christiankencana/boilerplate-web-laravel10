<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CheckActiveStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    // /**
    //  * Handle the event.
    //  */
    // public function handle(object $event): void
    // {
    //     //
    // }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        if ($user->status_account === 'inactive') {
            Auth::logout();
            // abort(403, 'Your account is inactive.');
            abort(Response::make(view('pages.error.403'), 403));
        }
    }
}
