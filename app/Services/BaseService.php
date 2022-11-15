<?php

namespace App\Services;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class BaseService{
    /**
     * コンストラクタ
     *
     * @todo
     **/
    public function __construct()
    {

    }

    /**
     * @param $result
     * @param $message
     * @param int $httpCode
     * @return JsonResponse
     */
    public function sendResponse($result, $message, $httpCode = JsonResponse::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, $httpCode);
    }

    /**
     * @param $error
     * @param $errorMessage
     * @param int $httpCode
     * @return JsonResponse
     */
    public function sendError($error, $errorMessage, $httpCode = JsonResponse::HTTP_FORBIDDEN): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (isset($errorMessage))
            $response['data'] = $errorMessage;

        return response()->json($response, $httpCode);
    }

    /**
     * success response method.
     *
     * @param $result
     * @param $message
     *
     * @return \Illuminate\Http\Response
     */
    public function withData($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function failValidator(Validator $validator, $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $validator->errors()
        ];

        return response()->json($response, $code);
    }


}
