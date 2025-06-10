<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateInvoiceController extends Controller
{
    public function __invoke(UpdateInvoiceRequest $request, Invoice $invoice): JsonResource
    {
        $this->authorize('update', $invoice);
        $validated = $request->validated();

        return DB::transaction(function () use ($validated, $invoice) {
            $invoice->update($validated);

            if (isset($validated['items'])) {
                // Delete existing items
                $invoice->items()->delete();

                // Create new items
                foreach ($validated['items'] as $item) {
                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'description' => $item['description'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'total_price' => $item['quantity'] * $item['unit_price'],
                    ]);
                }

                // Recalculate totals
                $subtotal = $invoice->items->sum('total_price');
                $invoice->update([
                    'subtotal' => $subtotal,
                    'total_amount' => $subtotal - $invoice->discount_amount + $invoice->tax_amount,
                ]);
            }

            return new InvoiceResource(
                $invoice->load(['status', 'createdBy', 'items'])
            );
        });
    }
}
