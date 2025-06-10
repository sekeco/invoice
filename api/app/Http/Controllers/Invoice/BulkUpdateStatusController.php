<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use App\Models\InvoiceStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BulkUpdateStatusController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'uuid', 'exists:invoices,id'],
            'status_id' => ['required', 'uuid', 'exists:invoice_statuses,id'],
        ]);

        $status = InvoiceStatus::findOrFail($validated['status_id']);

        // Ensure status belongs to same organization as invoices
        if ($status->organization_id !== auth()->user()->currentOrganization()->id) {
            abort(403, 'Status belongs to different organization');
        }

        $invoices = Invoice::whereIn('id', $validated['ids'])
            ->where('organization_id', auth()->user()->currentOrganization()->id)
            ->get();

        foreach ($invoices as $invoice) {
            $this->authorize('update', $invoice);

            if (!$invoice->paid_at) {
                $invoice->update(['status_id' => $validated['status_id']]);
            }
        }

        return InvoiceResource::collection($invoices->fresh(['status', 'items']));
    }
}
