<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseStoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends BaseStoreRequest
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
            'label' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'road' => 'required|string|max:255',
            'block' => 'nullable|string|max:255',
            'number' => 'required|string|max:255',
            'bis' => 'nullable|string|max:255',
            'stairs' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'door' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:255',
            'locality' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'customer_id' => 'required|integer|min:1',
            'country' => 'required|string|max:255'
        ];
    }
}