<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\Organization\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class SwitchOrganizationController extends Controller
{
    public function __invoke(Organization $organization): JsonResponse|JsonResource
    {
        if (!auth()->user()->organizations()->where('id', $organization->id)->exists()) {
            return response()->json([
                'message' => 'You do not belong to this organization.',
            ], Response::HTTP_FORBIDDEN);
        }

        auth()->user()->setCurrentOrganization($organization);

        return new OrganizationResource($organization);
    }
}
