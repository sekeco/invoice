<?php

namespace App\Http\Controllers\InvoiceStatus;

use App\Http\Controllers\Controller;
use App\Http\Resources\Invoice\InvoiceStatusResource;
use App\Models\InvoiceStatus;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListInvoiceStatusesController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $statuses = InvoiceStatus::where('organization_id', auth()->user()->currentOrganization()->id)
            ->get();

        return InvoiceStatusResource::collection($statuses);
    }
}
