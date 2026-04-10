<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function view(User $user, Client $client): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function update(User $user, Client $client): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function delete(User $user, Client $client): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function restore(User $user, Client $client): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function forceDelete(User $user, Client $client): bool
    {
        return $user->role === 'owner';
    }
}
