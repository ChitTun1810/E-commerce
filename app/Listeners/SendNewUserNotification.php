<?php

namespace App\Listeners;

use App\Notifications\NewUserNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::where('utype','ADM')->get();

        Notification::send($admins, new NewUserNotification($event->user));
    }
}
