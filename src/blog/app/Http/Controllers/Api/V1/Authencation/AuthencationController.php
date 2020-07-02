<?php

namespace App\Http\Controllers\Api\V1\Authencation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Account;
use App\Http\Resources\User\UserResource;
use Validator;

class AuthencationController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return $this->apiResponse(401000, ['errors' => $validator->errors()], null, 401);
            }

            $credentials = request(['email', 'password']);

            if (! $token = auth()->attempt($credentials)) {
                return $this->apiResponse(401000, ['messages' => 'Email or password is invalid!!!'], null, 401);
            }

            if (auth()->user()->role_id == config('define.user') &&
                auth()->user()->status == config('define.active') &&
                auth()->user()->active == true) {
                return $this->apiResponse(200000, [
                    'code' =>  [
                        'access_token' => $token,
                        'token_type' => 'bearer',
                        'expires_in' => auth('api')->factory()->getTTL() * 60
                    ],
                    'user_information' => new UserResource(Account::me())
                ]);
            } else {
                auth()->logout();
                return $this->apiResponse(400000, ['messages' => 'You do not have this access!!!'], null, 400);
            }
        } catch (JWTException $e) {
            return $this->apiResponse(400000, ['messages' => 'Login failed !!!'], null, 400);
        }
    }

        /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            if (auth()->check()) {
                auth()->logout();

                $response = [
                    "code" => 200000,
                    "meta" => null,
                    "data" => [
                        "message" => "Logout successfully."
                    ]
                ];
                $status = 200;
            } else {
                $response = [
                    "code" => 401000,
                    "meta" => null,
                    "data" => [
                        "message" => "Logout failed !!!"
                    ]
                ];
                $status = 401;
            }

            return $this->apiResponse($response, $status);
        } catch (JWTException $e) {
            return $this->apiResponse(400000, ['messages' => 'Logout failed !!!'], null, 400);
        }
    }
}
