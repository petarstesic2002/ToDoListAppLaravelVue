<?php

namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class ApiResponse
{
    public static function rollback($ex, $message="Process not completed."){
        DB::rollBack();
        self::throw($ex, $message);
    }
    public static function throw($ex, $message ="Process not completed"){
        throw new HttpResponseException(response()->json(["message"=> $message], 500));
    }
    public static function sendResponse($dataResult, $message, $code=200){
        $response = [
            'success' => true,
            'data' => $dataResult
        ];
        if(!empty($message)){
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }
}
