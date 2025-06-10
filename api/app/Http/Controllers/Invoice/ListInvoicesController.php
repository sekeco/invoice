<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListInvoicesController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $invoices = Invoice::where('organization_id', auth()->user()->currentOrganization()->id)
            ->with(['status', 'createdBy'])
            ->latest()
            ->paginate();

        return InvoiceResource::collection($invoices);
    }
}
