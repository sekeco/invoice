<?php

namespace App\Http\Resources\Invoice;

use App\Http\Resources\Organization\OrganizationResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_address' => $this->client_address,
            'client_phone' => $this->client_phone,
            'status' => new InvoiceStatusResource($this->whenLoaded('status')),
            'currency' => $this->currency,
            'issue_date' => $this->issue_date,
            'due_date' => $this->due_date,
            'notes' => $this->notes,
            'subtotal' => $this->subtotal,
            'tax_amount' => $this->tax_amount,
            'discount_amount' => $this->discount_amount,
            'total_amount' => $this->total_amount,
            'paid_at' => $this->paid_at,
            'organization' => new OrganizationResource($this->whenLoaded('organization')),
            'created_by' => new UserResource($this->whenLoaded('createdBy')),
            'items' => InvoiceItemResource::collection($this->whenLoaded('items')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
