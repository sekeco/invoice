<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\CreateOrganizationRequest;
use App\Http\Resources\Organization\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CreateOrganizationController extends Controller
{
    public function __invoke(CreateOrganizationRequest $request): JsonResource
    {
        $organization = Organization::create([
            'id' => Str::uuid(),
            ...$request->validated(),
        ]);

        $organization->users()->attach($request->user(), [
            'id' => Str::uuid(),
            'role' => 'ADMIN',
        ]);

        return new OrganizationResource($organization);
    }
}
