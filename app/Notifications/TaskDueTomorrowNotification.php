<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskDueTomorrowNotification extends Notification
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
            'type' => 'TaskDueTomorrow',
            'title' => 'TaskDueTomorrow Notification',
            'message' => 'A TaskDueTomorrow event was triggered in UPNEZ Agency OS.',
            'data' => $this->payload,
            'action_url' => '/dashboard',
        ];
    }
}
