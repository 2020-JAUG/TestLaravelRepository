<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseUpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends BaseUpdateRequest
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
            'label' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'road' => 'nullable|string|max:255',
            'block' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:255',
            'bis' => 'nullable|string|max:255',
            'stairs' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'door' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'locality' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'customer_id' => 'nullable|integer|min:1',
            'country' => 'nullable|string|max:255'
        ];
    }
}