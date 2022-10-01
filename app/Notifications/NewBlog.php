<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBlog extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail','database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'username' => $this->user->username(),
            'email' => $this->user->emailAddress(),
        ];
    }

    // public function toMail(User $user)
    // {
    //     return (new NewReplyEmail($this->reply, $this->subscription, $user))
    //         ->to($user->emailAddress(), $user->name());
    // }

    // public function toDatabase(User $user)
    // {
    //     return [
    //         'type' => 'new_reply',
    //         'reply' => $this->reply->id(),
    //         'replyable_id' => $this->reply->replyable_id,
    //         'replyable_type' => $this->reply->replyable_type,
    //         'replyable_subject' => $this->reply->replyAble()->replyAbleSubject(),
    //     ];
    // }
}
