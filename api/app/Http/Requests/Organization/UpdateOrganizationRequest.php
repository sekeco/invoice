<?php

namespace App\Http\Requests\Organization;

class UpdateOrganizationRequest extends CreateOrganizationRequest
{
    public function rules(): array
    {
        return array_map(function ($rule) {
            if (is_array($rule) && in_array('required', $rule)) {
                return array_filter($rule, fn($item) => $item !== 'required');
            }
            return $rule;
        }, parent::rules());
    }
}
