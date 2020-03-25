<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'fullName' => 'required|max:50',
            'email' => 'required|unique:accounts,email|max:50',
            'phone' => 'required|max:10',
            'birthday' => 'required',
            'address' => 'required|max:50',
        ];
    }
}
