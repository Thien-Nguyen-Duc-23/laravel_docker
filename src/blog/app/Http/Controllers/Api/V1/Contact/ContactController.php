<?php

namespace App\Http\Controllers\Api\V1\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Validator;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|max:50',
            'email' => 'required|max:50',
            'subject' => 'required|max:100',
            'message' => 'required|max:255',
        ], [
            'fullName.required' => trans('home.fullNameRequired'),
            'fullName.max' => trans('home.fullNameMax'),
            'email.required' => trans('home.emailRequired'),
            'email.max' => trans('home.emailMax'),
            'subject.required' => trans('home.subjectRequired'),
            'subject.max' => trans('home.subjectMax'),
            'message.required' => trans('home.messageRequired'),
            'message.max' => trans('home.messageMax'),
        ]);
    
        if ($validator->fails()) {
            return $this->apiResponse(401000, ['errors' => $validator->errors()], null, 401);
        }
        
        $attributesContact = [
            'full_name' => $request->fullName,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => config('define.disable'),
        ];

        try {
            $result = Contact::create($attributesContact);
        } catch (Exception $exception) {
            return $this->apiResponse(400000, ['messages' => 'Some thing wrong !!!'], null, 400);
        }
        
        if ($result) {
            return $this->apiResponse(200000, ['messages' => trans('home.lbSendSuccess')], null, 200);
        } else {
            return $this->apiResponse(400000, ['messages' => trans('home.lbSendError')], null, 400);
        }
    }
}
