<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => request()->isMethod('post') ? 'required|max:50' : 'nullable',
            'email' => request()->isMethod('post') ? 'required|email|max:255|unique:users,email' : 'nullable',
            'password' => request()->isMethod('post') ? 'required|max:50' : 'nullable'
        ];
    }
}