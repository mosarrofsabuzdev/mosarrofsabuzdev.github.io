<?php

namespace App\Policies;

use App\Models\Notification;
use App\Models\User;

class NotificationPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function view(User $user, Notification $notification): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function update(User $user, Notification $notification): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function delete(User $user, Notification $notification): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function restore(User $user, Notification $notification): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function forceDelete(User $user, Notification $notification): bool
    {
        return $user->role === 'owner';
    }
}
