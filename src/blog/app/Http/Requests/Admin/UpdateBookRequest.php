<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'titleBook' => 'required|max:255',
            'coverImage' => 'image',
            'isbn' => 'required|max:20',
            'authorBook' => 'required|max:50',
            'descriptionBook' => 'required|max:600',
            'contentBook' => 'required',
        ];
    }
}
