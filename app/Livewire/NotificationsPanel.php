<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsPanel extends Component
{
    public string $tab = 'unread';

    public function markAllAsRead(): void
    {
        if (! Auth::check()) {
            return;
        }

        Auth::user()->appNotifications()->whereNull('read_at')->update(['read_at' => now()]);
    }

    public function clearAll(): void
    {
        if (! Auth::check()) {
            return;
        }

        Auth::user()->appNotifications()->delete();
    }

    public function render()
    {
        if (! Auth::check()) {
            return view('livewire.notifications-panel', ['notifications' => collect()]);
        }

        $query = Auth::user()->appNotifications()->latest();
        $notifications = $this->tab === 'unread'
            ? $query->whereNull('read_at')->limit(20)->get()
            : $query->limit(20)->get();

        return view('livewire.notifications-panel', compact('notifications'));
    }
}
