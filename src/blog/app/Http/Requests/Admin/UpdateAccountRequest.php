<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
        define('GET_ID_URL', 3);

        // dd($request->all());
        return [
            'fullName' => 'required|max:50',
            'email' => 'required|max:50|unique:accounts,email,'.$this->segment(GET_ID_URL),
            'phone' => 'required|max:10',
            'birthday' => 'required',
            'address' => 'required|max:50',
        ];
    }
}
