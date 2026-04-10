<div class="h-full flex flex-col" wire:poll.30s>
    <div class="p-4 border-b"><h2 class="font-semibold">Notifications</h2><div class="mt-2 flex gap-2 text-xs"><button wire:click="$set('tab','unread')" class="px-2 py-1 rounded bg-slate-100">Unread</button><button wire:click="$set('tab','all')" class="px-2 py-1 rounded bg-slate-100">All</button></div></div>
    <div class="flex-1 overflow-y-auto">@forelse($notifications as $notification)<x-notification-row :title="$notification->title" :message="$notification->message" :time="$notification->created_at->diffForHumans()" />@empty<div class="p-4"><x-empty-state title="No notifications" /></div>@endforelse</div>
    <div class="p-4 border-t flex gap-2"><button wire:click="markAllAsRead" class="px-3 py-2 text-xs bg-slate-100 rounded">Mark all as read</button><button wire:click="clearAll" class="px-3 py-2 text-xs bg-red-100 text-red-700 rounded">Clear all</button></div>
</div>
