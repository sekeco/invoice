<?php

namespace App\Http\Controllers\InvoiceStatus;

use App\Http\Controllers\Controller;
use App\Models\InvoiceStatus;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteInvoiceStatusController extends Controller
{
    public function __invoke(InvoiceStatus $status): JsonResponse
    {
        $this->authorize('delete', $status);

        if ($status->is_default) {
            return response()->json([
                'message' => 'Cannot delete the default status.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($status->invoices()->exists()) {
            return response()->json([
                'message' => 'Cannot delete a status that has invoices.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $status->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
