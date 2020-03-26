<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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

        return [
            'editCategoryName' => 'required|max:255|unique:categories,name,'.$this->segment(GET_ID_URL),
            'editCoverImage' => 'image',
        ];
    }
}
