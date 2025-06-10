<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class RestoreInvoiceController extends Controller
{
    public function __invoke(string $id): JsonResponse|JsonResource
    {
        $invoice = Invoice::withTrashed()->findOrFail($id);

        $this->authorize('restore', $invoice);

        $invoice->restore();

        return new InvoiceResource($invoice->load(['status', 'items']));
    }
}
