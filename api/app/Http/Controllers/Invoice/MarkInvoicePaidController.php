<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Resources\Json\JsonResource;

class MarkInvoicePaidController extends Controller
{
    public function __invoke(Invoice $invoice): JsonResource
    {
        $this->authorize('update', $invoice);

        if ($invoice->paid_at) {
            return new InvoiceResource($invoice);
        }

        $invoice->update([
            'paid_at' => now(),
        ]);

        return new InvoiceResource($invoice->load(['status', 'items']));
    }
}
