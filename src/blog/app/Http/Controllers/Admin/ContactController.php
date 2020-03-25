<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ContactService;
use Exception;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $contact;

    // inject ContactService in construct
    public function __construct(ContactService $contactService)
    {
        $this->contact = $contactService;
    }

    /**
     * Show the form for index a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $getContacts = $this->contact->getContacts();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.contacts.view', compact('getContacts'));
    }
}
