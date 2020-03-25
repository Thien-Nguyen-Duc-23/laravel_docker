<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Http\Requests\Admin\AccountRequest;
use Exception;
use App\Http\Requests\Admin\UpdateAccountRequest;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // declare variable accountInterfaceRepository
    protected $account;

    // inject AccountInterfaceRepository in construct
    public function __construct(AccountService $accounts)
    {
        $this->account = $accounts;
    }

    // get all accounts
    public function index()
    {
        try {
            $getAllInformatons = $this->account->accountLess(Auth::guard('admin')->user()->role_id);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('admin.users.view', compact('getAllInformatons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('admin')->user()->role_id == config('define.superAdmin')) {
            return view('admin.users.insert');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $getInformation = $this->account->editAccount($id);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if (Auth::guard('admin')->user()->role_id == config('define.superAdmin')) {
            return view('admin.users.edit', compact('getInformation'));
        } else {
            if (Auth::guard('admin')->user()->can('update', $getInformation)) {
                return view('admin.users.edit', compact('getInformation'));
            } else {
                return abort(403, 'Unauthorized action.');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {
        try {
            $result = $this->account->updateAccount($request, $id);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->route('users.index')->with(['flag' => 'success', 'message' => 'Update Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Update Account Fail!!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        try {
            $result = $this->account->storeAccount($request);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->route('users.index')->with(['flag' => 'success', 'message' => 'Insert Account Success']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Insert Account Fail!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->account->deleteAccount($id);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if ($result) {
            return redirect()->back()->with(['flag' => 'success', 'message' => 'Delete Account Success!!']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Delete Account Fail!!']);
        }
    }
}
