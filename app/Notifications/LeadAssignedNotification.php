<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LeadAssignedNotification extends Notification
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
            'type' => 'LeadAssigned',
            'title' => 'LeadAssigned Notification',
            'message' => 'A LeadAssigned event was triggered in UPNEZ Agency OS.',
            'data' => $this->payload,
            'action_url' => '/dashboard',
        ];
    }
}
