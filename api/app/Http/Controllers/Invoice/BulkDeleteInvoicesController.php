<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BulkDeleteInvoicesController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'uuid', 'exists:invoices,id'],
        ]);

        $invoices = Invoice::whereIn('id', $validated['ids'])
            ->where('organization_id', auth()->user()->currentOrganization()->id)
            ->get();

        foreach ($invoices as $invoice) {
            $this->authorize('delete', $invoice);

            if (!$invoice->paid_at) {
                $invoice->delete();
            }
        }

        return response()->json(null, 204);
    }
}
