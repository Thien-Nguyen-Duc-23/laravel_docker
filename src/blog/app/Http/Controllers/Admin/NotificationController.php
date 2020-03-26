<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Account;

class NotificationController extends Controller
{
    public function show($id)
    {
        $notification = Auth::guard('admin')->user()->unreadNotifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['link']);
        }
    }

    public function markAll($accountID)
    {
        try {
            $user = Account::find($accountID);
            $user->unreadNotifications()->update(['read_at' => now()]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return back();
    }
}
