<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\Organization\OrganizationDetailResource;
use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowOrganizationController extends Controller
{
    public function __invoke(Organization $organization): JsonResource
    {
        $this->authorize('view', $organization);

        return new OrganizationDetailResource(
            $organization->load(['users'])
        );
    }
}
