<?php

namespace App\Http\Responses;

class AppResponse
{
    
    public static function success( $message = null, $data = null, $code = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ], $code);
    }

    public  static function error( $message = null, $data = null, $code = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ], $code);
    }
}
