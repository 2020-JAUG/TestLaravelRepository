<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => request()->isMethod('post') ? 'required' : 'nullable' . '|string|max:255',
            'type' => request()->isMethod('post') ? 'required' : 'nullable' . '|string|max:255',
            'road' => request()->isMethod('post') ? 'required' : 'nullable' . '|string|max:255',
            'block' => 'nullable|string|max:255',
            'number' => request()->isMethod('post') ? 'required' : 'nullable' . '|string|max:255',
            'bis' => 'nullable|string|max:255',
            'stair' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'door' => 'nullable|string|max:255',
            'postal_code' => request()->isMethod('post') ? 'required' : 'nullable' . '|string|max:255',
            'locality' => request()->isMethod('post') ? 'required' : 'nullable' . '|string|max:255',
            'province' => request()->isMethod('post') ? 'required' : 'nullable' . '|string|max:255',
            'customer_id' => request()->isMethod('post') ? 'required' : 'nullable' . '|integer|min:1',
            'country' => request()->isMethod('post') ? 'required' : 'nullable' . '|string|max:255'
        ];
    }
}