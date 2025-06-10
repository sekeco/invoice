<?php

namespace App\Http\Controllers\InvoiceStatus;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceStatus\UpdateInvoiceStatusRequest;
use App\Http\Resources\Invoice\InvoiceStatusResource;
use App\Models\InvoiceStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateInvoiceStatusController extends Controller
{
    public function __invoke(UpdateInvoiceStatusRequest $request, InvoiceStatus $status): JsonResource
    {
        $this->authorize('update', $status);

        $status->update($request->validated());

        if ($status->is_default) {
            InvoiceStatus::where('organization_id', $status->organization_id)
                ->where('id', '!=', $status->id)
                ->update(['is_default' => false]);
        }

        return new InvoiceStatusResource($status);
    }
}
