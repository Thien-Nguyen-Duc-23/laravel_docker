<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'email' => 'required|max:50',
            'subject' => 'required|max:100',
            'message' => 'required|max:255',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function messages()
    {
        return [
            'fullName.required' => trans('home.fullNameRequired'),
            'fullName.max' => trans('home.fullNameMax'),
            'email.required' => trans('home.emailRequired'),
            'email.max' => trans('home.emailMax'),
            'subject.required' => trans('home.subjectRequired'),
            'subject.max' => trans('home.subjectMax'),
            'message.required' => trans('home.messageRequired'),
            'message.max' => trans('home.messageMax'),
            'g-recaptcha-response.required' => trans('home.recaptchaRequired'),
            'g-recaptcha-response.captcha' => trans('home.recaptcha'),
        ];
    }
}
