<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ClientHealthDroppedNotification extends Notification
{
    use Queueable;

    public function __construct(public mixed $payload = null)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'ClientHealthDropped',
            'title' => 'ClientHealthDropped Notification',
            'message' => 'A ClientHealthDropped event was triggered in UPNEZ Agency OS.',
            'data' => $this->payload,
            'action_url' => '/dashboard',
        ];
    }
}
