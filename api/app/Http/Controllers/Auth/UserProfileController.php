<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\AuthenticatedUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileController extends Controller
{
    public function __invoke(): JsonResource
    {
        return new AuthenticatedUserResource(
            auth()->user()->load(['organizations'])
        );
    }
}
