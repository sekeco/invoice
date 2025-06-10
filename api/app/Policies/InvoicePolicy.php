<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function view(User $user, Invoice $invoice): bool
    {
        return $invoice->organization->users()->where('user_id', $user->id)->exists();
    }

    public function create(User $user): bool
    {
        return true; // User must be in an organization to create invoices
    }

    public function update(User $user, Invoice $invoice): bool
    {
        if ($invoice->paid_at) {
            return false; // Cannot update paid invoices
        }

        return $invoice->organization->users()->where('user_id', $user->id)->exists();
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        if ($invoice->paid_at) {
            return false; // Cannot delete paid invoices
        }

        return $invoice->organization->users()
            ->where('user_id', $user->id)
            ->where('role', 'ADMIN')
            ->exists();
    }

    public function restore(User $user, Invoice $invoice): bool
    {
        return $invoice->organization->users()
            ->where('user_id', $user->id)
            ->where('role', 'ADMIN')
            ->exists();
    }
}
