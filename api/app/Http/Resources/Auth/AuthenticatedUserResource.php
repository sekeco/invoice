<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticatedUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'current_organization' => $this->whenLoaded(
                'currentOrganization',
                fn() =>
                new \App\Http\Resources\Organization\OrganizationResource($this->currentOrganization())
            ),
            'organizations' => \App\Http\Resources\Organization\OrganizationResource::collection(
                $this->whenLoaded('organizations')
            ),
            'created_at' => $this->created_at,
        ];
    }
}
