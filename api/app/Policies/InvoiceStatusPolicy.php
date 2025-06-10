<?php

namespace App\Policies;

use App\Models\InvoiceStatus;
use App\Models\User;

class InvoiceStatusPolicy
{
    public function view(User $user, InvoiceStatus $status): bool
    {
        return $status->organization->users()->where('user_id', $user->id)->exists();
    }

    public function create(User $user): bool
    {
        return true; // User must be in an organization to create statuses
    }

    public function update(User $user, InvoiceStatus $status): bool
    {
        return $status->organization->users()
            ->where('user_id', $user->id)
            ->where('role', 'ADMIN')
            ->exists();
    }

    public function delete(User $user, InvoiceStatus $status): bool
    {
        if ($status->is_default) {
            return false; // Cannot delete default status
        }

        return $status->organization->users()
            ->where('user_id', $user->id)
            ->where('role', 'ADMIN')
            ->exists();
    }
}
