<?php
namespace App\Traits;

trait ApiTrait{

    function apiResponse($data = null, $message = null, $code = 200, $status = 0): \Illuminate\Http\Response
    {
        $isSuccessful = in_array($code, [200, 201, 202, 203]);

        $response = [
            'code' => $code,
            'status' => $status === 0 ? $isSuccessful : (bool)$status,
            'message' => $message,
            'data' => $data,
        ];

        return response($response, $code);
    }

}
