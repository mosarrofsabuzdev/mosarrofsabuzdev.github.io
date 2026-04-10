<?php

namespace App\Policies;

use App\Models\TimeEntry;
use App\Models\User;

class TimeEntryPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function view(User $user, TimeEntry $timeentry): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function update(User $user, TimeEntry $timeentry): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function delete(User $user, TimeEntry $timeentry): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function restore(User $user, TimeEntry $timeentry): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function forceDelete(User $user, TimeEntry $timeentry): bool
    {
        return $user->role === 'owner';
    }
}
