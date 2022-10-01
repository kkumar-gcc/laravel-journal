<?php

namespace App\Listeners;

use App\Events\BlogWasCreated;
use App\Notifications\NewBlogNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewBlogNotification
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
     * @param  \App\Events\BlogWasCreated  $event
     * @return void
     */
    public function handle(BlogWasCreated $event)
    {
        $users = $event->blog->user->subscribers;
        
        Notification::send($users, new NewBlogNotification($event->blog,$event->blog->user));
    }
}
