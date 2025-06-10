<?php

namespace App\Http\Requests\InvoiceStatus;

use Illuminate\Validation\Rule;

class UpdateInvoiceStatusRequest extends CreateInvoiceStatusRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        // Update unique rule to ignore current status
        $rules['name'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('invoice_statuses')->where(function ($query) {
                return $query->where('organization_id', $this->user()->currentOrganization()->id);
            })->ignore($this->route('status')),
        ];

        return $rules;
    }
}
