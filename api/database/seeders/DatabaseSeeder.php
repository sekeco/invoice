<?php

namespace Database\Seeders;

use App\Enums\OrganizationUserRole;
use App\Models\Invoice;
use App\Models\InvoiceStatus;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'name' => 'Admin User',
        ]);

        // Create organization
        $organization = Organization::factory()->create([
            'name' => 'Demo Organization',
        ]);

        // Attach admin to organization
        $organization->users()->attach($admin, [
            'role' => OrganizationUserRole::ADMIN->value,
        ]);

        // Create invoice statuses
        $defaultStatus = InvoiceStatus::factory()->create([
            'name' => 'Draft',
            'color' => '#6B7280',
            'is_default' => true,
            'organization_id' => $organization->id,
        ]);

        InvoiceStatus::factory()->count(4)->create([
            'organization_id' => $organization->id,
        ]);

        // Create some invoices
        Invoice::factory()
            ->count(10)
            ->create([
                'organization_id' => $organization->id,
                'created_by_id' => $admin->id,
                'status_id' => $defaultStatus->id,
            ]);

        // Create additional users and organizations for testing
        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                $org = Organization::factory()->create();
                $org->users()->attach($user, [
                    'role' => OrganizationUserRole::ADMIN->value,
                ]);
            });
    }
}
