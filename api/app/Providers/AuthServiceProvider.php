<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Models\InvoiceStatus;
use App\Models\Organization;
use App\Policies\InvoicePolicy;
use App\Policies\InvoiceStatusPolicy;
use App\Policies\OrganizationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Organization::class => OrganizationPolicy::class,
        Invoice::class => InvoicePolicy::class,
        InvoiceStatus::class => InvoiceStatusPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
