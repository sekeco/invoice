<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AddOrganizationMemberController extends Controller
{
    public function __invoke(Request $request, Organization $organization): JsonResponse
    {
        $this->authorize('addUser', $organization);

        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'role' => ['required', 'in:ADMIN,MEMBER'],
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        // Check if user is already a member
        if ($organization->users()->where('user_id', $user->id)->exists()) {
            return response()->json([
                'message' => 'User is already a member of this organization.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $organization->users()->attach($user, [
            'role' => $validated['role'],
        ]);

        return response()->json([
            'message' => 'User added successfully',
            'user' => new UserResource($user),
        ]);
    }
}
