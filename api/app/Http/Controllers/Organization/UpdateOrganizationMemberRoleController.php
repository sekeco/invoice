<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrganizationMemberRoleController extends Controller
{
    public function __invoke(Request $request, Organization $organization, User $user): JsonResponse
    {
        $this->authorize('addUser', $organization);

        $validated = $request->validate([
            'role' => ['required', 'in:ADMIN,MEMBER'],
        ]);

        // Check if user is a member
        if (!$organization->users()->where('user_id', $user->id)->exists()) {
            return response()->json([
                'message' => 'User is not a member of this organization.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Check if changing own role and is last admin
        if (
            $user->id === auth()->id() &&
            $validated['role'] === 'MEMBER' &&
            $organization->users()->where('role', 'ADMIN')->count() === 1
        ) {
            return response()->json([
                'message' => 'Cannot remove the last administrator.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $organization->users()->updateExistingPivot($user->id, [
            'role' => $validated['role'],
        ]);

        return response()->json([
            'message' => 'User role updated successfully',
        ]);
    }
}
