<?php
namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class NotificationsPanel extends Component
{
    public string $tab = 'unread';

    public function markAllAsRead(): void
    {
        Auth::user()?->appNotifications()->whereNull('read_at')->update(['read_at' => now()]);
    }

    public function clearAll(): void
    {
        Auth::user()?->appNotifications()->delete();
    }

    public function render()
    {
        $query = Auth::user()?->appNotifications()->latest() ?? collect();
        $notifications = $this->tab === 'unread' ? $query->whereNull('read_at')->limit(20)->get() : $query->limit(20)->get();

        return view('livewire.notifications-panel', compact('notifications'));
    }
}
