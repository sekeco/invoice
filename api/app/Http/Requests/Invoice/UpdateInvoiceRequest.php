<?php

namespace App\Http\Requests\Invoice;

class UpdateInvoiceRequest extends CreateInvoiceRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        // Make items optional for updates
        $rules['items'] = ['sometimes', 'array', 'min:1'];

        return $rules;
    }
}
