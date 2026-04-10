<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;

class EmployeePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function view(User $user, Employee $employee): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function update(User $user, Employee $employee): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function delete(User $user, Employee $employee): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function restore(User $user, Employee $employee): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function forceDelete(User $user, Employee $employee): bool
    {
        return $user->role === 'owner';
    }
}
