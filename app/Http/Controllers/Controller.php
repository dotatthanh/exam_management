<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function responseError($status, $data, $message = '')
    {
        $response = [
            'status' => 'error',
            'data' => $data,
            'message' => $message,
        ];

        if ($message !== null) {
            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }

    public function responseSuccess($status, $data, $message = '')
    {
        $response = [
            'status' => 'success',
            'data' => $data,
            'message' => $message,
        ];

        if ($message !== null) {
            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }
}
