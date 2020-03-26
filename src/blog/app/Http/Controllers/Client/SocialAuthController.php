<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use Socialite;
use Auth;
use Exception;

class SocialAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $social;
    
    // inject BookService in construct
    public function __construct(SocialAccountService $social)
    {
        $this->social = $social;
    }

    // function redirect
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // function callback
    public function callback()
    {
        try {
            $user = $this->social->createOrGetUser(Socialite::driver('facebook')->user());
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        Auth::guard('client')->login($user);

        return redirect()->route('index');
    }
}
