<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\InformationAccount\InformationAccountInterfaceRepository as info;
use App\Services\AccountService;
use App\Http\Requests\Client\EditProfileRequest;
use App\Http\Requests\Client\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

class ClientProfileController extends Controller
{
    protected $info;
    protected $account;

    public function __construct(info $info, AccountService $account)
    {
        $this->info = $info;
        $this->account = $account;
    }

    public function index()
    {
        return view('client.profile.index');
    }

    public function editAccount(EditProfileRequest $request)
    {
        $id = $request->id;
        $this->account->editProfile($request, $id);
        
        return back()->with(['flag' => 'success', 'message' => 'Update Profile Success!!']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->old_password, Auth::guard('client')->user()->userInformation->account->password)) {
            return response()->json(['error' => 'The old password does not match our records.']);
        } else {
            $id = $request->id;
            $this->account->changePassword($request, $id);
            return response()->json(['success' => 'Update password success']);
        }
    }
}
