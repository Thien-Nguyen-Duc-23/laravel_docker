<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreContactRequest;
use App\Services\ContactService;
use Exception;

class ContactController extends Controller
{
    // declare variable accountInterfaceRepository
    protected $contact;

    // inject AccountInterfaceRepository in construct
    public function __construct(ContactService $contacts)
    {
        $this->contact = $contacts;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        try {
            $result = $this->contact->storeContact($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        if ($result) {
            return redirect()->back()->with(['flag' => 'success', 'message' => trans('home.lbSendSuccess')]);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => trans('home.lbSendError')]);
        }
    }
}
