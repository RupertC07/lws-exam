<?php

namespace App\Http\Responses;

class AppResponse
{

    //we create a custom response so, we can return a proper response. And at the same time, reusable
    
    public static function success( $message = null, $data = null, $code = null)
    {
        //this will handle  our actual return json that will be used by our repos
        //success response
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ], $code);
    }

    public  static function error( $message = null, $data = null, $code = null)
    {
        //this will handle our actual return json that will be used by our repos
        //error response
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ], $code);
    }
}
