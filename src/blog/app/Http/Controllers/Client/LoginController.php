<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Http\Requests\Admin\LoginRequest;

class LoginController extends Controller
{
    protected $account;

    public function __construct(AccountService $account)
    {
        $this->middleware('guest:client')->except('logoutClient');
        $this->account = $account;
    }

    // function create view login
    public function indexLogin()
    {
        session(['link' => url()->previous()]);
        return view('client.login.index');
    }

    public function loginClient(LoginRequest $request)
    {
        try {
            $this->account->loginClient($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect()->back()->withInput();
    }

    public function logoutClient()
    {
        try {
            $this->account->logoutClinet();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect()->route('index');
    }
}
