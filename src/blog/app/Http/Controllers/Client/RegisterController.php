<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RegisterRequest;
use App\Services\AccountService;
use Illuminate\Auth\Events\Registered;
use App\Services\ActivationService;

class RegisterController extends Controller
{
    protected $account;
    protected $activationService;

    //inject AccountService
    public function __construct(AccountService $account, ActivationService $activationService)
    {
        $this->account = $account;
        $this->activationService = $activationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        try {
            $result = $this->account->registerUser($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        if ($result) {
            return redirect()->back()->with(['flag' => 'success', 'message' => trans('register.successMes')]);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => trans('register.failMes')]);
        }
    }

    public function activateUser($token)
    {
        try {
            $result = $this->account->autoLogin($token);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
           
        return redirect()->route('index');
    }
}
