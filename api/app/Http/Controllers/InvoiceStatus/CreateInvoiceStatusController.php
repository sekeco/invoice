<?php

namespace App\Http\Controllers\InvoiceStatus;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceStatus\CreateInvoiceStatusRequest;
use App\Http\Resources\Invoice\InvoiceStatusResource;
use App\Models\InvoiceStatus;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CreateInvoiceStatusController extends Controller
{
    public function __invoke(CreateInvoiceStatusRequest $request): JsonResource
    {
        $status = InvoiceStatus::create($request->validated());

        if ($status->is_default) {
            InvoiceStatus::where('organization_id', $status->organization_id)
                ->where('id', '!=', $status->id)
                ->update(['is_default' => false]);
        }

        return new InvoiceStatusResource($status);
    }
}
