<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use App\Http\Resources\Organization\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateOrganizationController extends Controller
{
    public function __invoke(UpdateOrganizationRequest $request, Organization $organization): JsonResource
    {
        $this->authorize('update', $organization);

        $organization->update($request->validated());

        return new OrganizationResource($organization);
    }
}
