<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\CreateInvoiceRequest;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateInvoiceController extends Controller
{
    public function __invoke(CreateInvoiceRequest $request): JsonResource
    {
        $validated = $request->validated();

        // Generate invoice number (you might want to customize this)
        $nextNumber = Invoice::where('organization_id', $request->organization_id)
            ->count() + 1;
        $invoiceNumber = sprintf('INV-%06d', $nextNumber);

        return DB::transaction(function () use ($validated, $invoiceNumber) {
            $invoice = Invoice::create([
                'id' => Str::uuid(),
                ...$validated,
                'invoice_number' => $invoiceNumber,
                'subtotal' => 0,
                'tax_amount' => 0,
                'discount_amount' => 0,
                'total_amount' => 0,
            ]);

            // Create invoice items
            foreach ($validated['items'] as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                ]);
            }

            // Calculate totals
            $subtotal = $invoice->items->sum('total_price');
            $invoice->update([
                'subtotal' => $subtotal,
                'total_amount' => $subtotal - $invoice->discount_amount + $invoice->tax_amount,
            ]);

            return new InvoiceResource(
                $invoice->load(['status', 'createdBy', 'items'])
            );
        });
    }
}
