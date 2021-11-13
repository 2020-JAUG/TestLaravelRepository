<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date|date_format:YYYY-MM-DD',
            'disability_degree' => 'nullable|integer|max:100',
            'genre' => 'required|integer|min:0|max:1',
            'phone' => 'required|string',
            'mobile_phone' => 'nullable|string',
            'additional_contacts' => 'nullable|string',
            'status' => 'required|integer|min:0|max:1',
            'user_id' => 'required|integer|min:1'
        ];
    }
}