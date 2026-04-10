<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function view(User $user, Company $company): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function update(User $user, Company $company): bool
    {
        return in_array($user->role, ['owner', 'manager', 'staff'], true);
    }

    public function delete(User $user, Company $company): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function restore(User $user, Company $company): bool
    {
        return in_array($user->role, ['owner', 'manager'], true);
    }

    public function forceDelete(User $user, Company $company): bool
    {
        return $user->role === 'owner';
    }
}
