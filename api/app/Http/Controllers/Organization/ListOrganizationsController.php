<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\Organization\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListOrganizationsController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $organizations = Organization::whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return OrganizationResource::collection($organizations);
    }
}
