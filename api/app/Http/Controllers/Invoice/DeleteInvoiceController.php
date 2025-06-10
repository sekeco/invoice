<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteInvoiceController extends Controller
{
    public function __invoke(Invoice $invoice): JsonResponse
    {
        $this->authorize('delete', $invoice);

        if ($invoice->paid_at) {
            return response()->json([
                'message' => 'Cannot delete a paid invoice.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $invoice->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
