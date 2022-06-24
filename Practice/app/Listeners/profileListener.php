<?php

namespace App\Listeners;

use App\Events\someOneCheckedYourProfile;
use App\Jobs\someCheckedProfile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class profileListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\someOneCheckedYourProfile  $event
     * @return void
     */
    public function handle(someOneCheckedYourProfile $event)
    {
        //
        someCheckedProfile::dispatch($event->user)->delay(now()->addSeconds(3));
    }
}
