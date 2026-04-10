<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;

class ContactPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function view(User $user, Contact $contact): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function update(User $user, Contact $contact): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function delete(User $user, Contact $contact): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function restore(User $user, Contact $contact): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function forceDelete(User $user, Contact $contact): bool
    {
        return $user->role === 'owner';
    }
}
