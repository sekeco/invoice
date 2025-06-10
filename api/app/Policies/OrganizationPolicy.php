<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;

class OrganizationPolicy
{
    public function view(User $user, Organization $organization): bool
    {
        return $organization->users()->where('user_id', $user->id)->exists();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Organization $organization): bool
    {
        return $organization->users()
            ->where('user_id', $user->id)
            ->where('role', 'ADMIN')
            ->exists();
    }

    public function delete(User $user, Organization $organization): bool
    {
        return $organization->users()
            ->where('user_id', $user->id)
            ->where('role', 'ADMIN')
            ->exists();
    }

    public function addUser(User $user, Organization $organization): bool
    {
        return $organization->users()
            ->where('user_id', $user->id)
            ->where('role', 'ADMIN')
            ->exists();
    }

    public function removeUser(User $user, Organization $organization): bool
    {
        return $organization->users()
            ->where('user_id', $user->id)
            ->where('role', 'ADMIN')
            ->exists();
    }
}
