<?php

namespace App\Listeners;

use App\Events\EventCreated;
use App\Models\User;
use App\Notifications\NewEvent;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventCreated $event): void
    {
        foreach (User::whereNot('id', '')->cursor() as $user) {
            $user->notify(new NewEvent($event->event));
        }
    }
}
