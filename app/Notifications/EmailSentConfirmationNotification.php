<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EmailSentConfirmationNotification extends Notification
{
    use Queueable;

    public function __construct(public mixed $payload = null) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'EmailSentConfirmation',
            'title' => 'EmailSentConfirmation Notification',
            'message' => 'An EmailSentConfirmation event was triggered in UPNEZ Agency OS.',
            'data' => $this->payload,
            'action_url' => '/dashboard',
        ];
    }
}
