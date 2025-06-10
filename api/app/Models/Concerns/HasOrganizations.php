<?php

namespace App\Models\Concerns;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Session;

trait HasOrganizations
{
    public function currentOrganization(): ?Organization
    {
        $organizationId = Session::get('current_organization_id');

        if (!$organizationId) {
            // If no organization is set, use the first one
            $organization = $this->organizations()->first();
            if ($organization) {
                $this->setCurrentOrganization($organization);
                return $organization;
            }
            return null;
        }

        return $this->organizations()->find($organizationId);
    }

    public function setCurrentOrganization(Organization $organization): void
    {
        if ($this->organizations()->where('id', $organization->id)->exists()) {
            Session::put('current_organization_id', $organization->id);
        }
    }

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'organization_users')
            ->withPivot('role')
            ->withTimestamps();
    }
}
