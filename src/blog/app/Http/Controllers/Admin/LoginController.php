<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoginRequest;
use App\Http\Controllers\Controller;
use App\Services\AccountService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $account;

    public function __construct(AccountService $account)
    {
        $this->middleware('guest:admin')->except('logout');
        $this->account = $account;
    }

    public function index(Request $request)
    {
        return view('admin.login.login');
    }

    public function submitLogin(LoginRequest $request)
    {
        try {
            $this->account->loginAdmin($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect()->back()->withInput();
    }

    public function logout()
    {
        try {
            $this->account->logoutAdmin();
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return redirect()->route('admin.login.index');
    }
}
