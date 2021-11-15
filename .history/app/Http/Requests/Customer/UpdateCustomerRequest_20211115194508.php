<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\BaseUpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends BaseUpdateRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'nullable|string|max:255',
            'family_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date|date_format:Y-m-d',
            'disability_degree' => 'nullable|integer|max:100',
            'genre' => 'nullable|integer|min:0|max:1',
            'phone' => 'nullable|string',
            'mobile_phone' => 'nullable|string',
            'additional_contacts' => 'nullable|string',
            'status' => 'nullable|integer|min:0|max:1',
            'user_id' => 'nullable|integer|min:1'
        ];
    }
}