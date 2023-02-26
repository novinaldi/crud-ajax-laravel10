<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'email' => [
                'required',
                Rule::unique('customers','email')->ignore($this->id, 'id'),
                'email'
            ],
            'phone' => 'required|numeric',
            'photo' => 'mimes:jpg,png,jpeg|max:2048'
        ];
    }
}
