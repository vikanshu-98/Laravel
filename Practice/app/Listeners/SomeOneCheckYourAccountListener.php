<?php

namespace App\Listeners;

use App\Events\SomeOneCheckYourAccount;
use App\Mail\testingMailable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;

class SomeOneCheckYourAccountListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */ 
    public function __construct()
    {
          
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\=SomeOneCheckYourAccount  $event
     * @return void
     */
    public function handle(SomeOneCheckYourAccount $event)
    { 
        Mail::to($event->user->email)->send(new testingMailable($event->user));
        echo 'mail sent successfully';
    }
}
