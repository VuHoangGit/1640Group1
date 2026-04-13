<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Idea;

class IdeaPosted extends Notification
{
use Queueable;

    // 1. Declare the public property
    public $idea;

    // 2. Assign the idea in the constructor
    public function __construct(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        // Now $this->idea will work correctly!
        return [
            'idea_id'   => $this->idea->id,
            'title'     => $this->idea->title,
            'message'   => 'A new idea was posted in ' . $this->idea->category->name,
            'user_name' => $this->idea->user->name,
        ];
    }
}
