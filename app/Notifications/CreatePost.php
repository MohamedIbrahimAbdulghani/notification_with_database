<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatePost extends Notification
{
    use Queueable;
    private $post_id;
    private $user_name;
    private $post_title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post_id, $user_name, $post_title)
    {
        $this->post_id = $post_id;
        $this->user_name = $user_name;
        $this->post_title = $post_title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            "post_id" => $this->post_id,
            "user_name" => $this->user_name,
            "post_title" => $this->post_title
        ];
    }
}
