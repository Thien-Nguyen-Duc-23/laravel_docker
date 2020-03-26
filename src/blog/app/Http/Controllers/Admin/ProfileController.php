<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePassword;
use App\Services\AccountService;
use Auth;
use Hash;

class ProfileController extends Controller
{
    // declare variable accountInterfaceRepository
    protected $account;

    // inject AccountInterfaceRepository in construct
    public function __construct(AccountService $account)
    {
        $this->account = $account;
    }

    // function get view profile
    public function index()
    {
        return view('admin.profile.profile');
    }

    // function change password
    public function changePassword(ChangePassword $request)
    {
        if (!Hash::check($request->oldPassword, Auth::guard('admin')->user()->userInformation->account->password)) {
            return response()->json(['errors' => 'The old password does not match our records.']);
        } else {
            $id = Auth::guard('admin')->user()->id;
            $this->account->changePasswordAdmin($id, $request);
            return response()->json(['success' => 'Change password Success!!']);
        }
    }
}
