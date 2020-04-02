<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param int $code
     * @param null $data
     * @param null $meta
     * @param int $status
     *
     * API response format
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiResponse ($code = 200000, $data = null, $meta = null, $status = 200) {
        return response()->json([
            'code' => $code,
            'meta' => $meta,
            'data' => $data,
        ], $status);
    }
}
