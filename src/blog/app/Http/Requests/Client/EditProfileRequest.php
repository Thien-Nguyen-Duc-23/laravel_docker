<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'full_name' => 'required|max:50',
            'user_phone' => 'required|max:10',
            'user_dob' => 'required',
            'user_address' => 'required|max:50',
        ];
    }
}
