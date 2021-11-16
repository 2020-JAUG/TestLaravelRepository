<?php

namespace App\Traits;

use Exception;

trait ResponseApi
{
    /**
     * Core response
     *
     * @param string $message
     * @param array|object $data
     * @param int $statusCode
     * @param bool $isSuccess
     *
     * @return \Illuminate\Http\Response
     */
    public function coreResponse(string $message,  $data = null, int $statusCode, bool $isSuccess = true)
    {
        //Send the response if it is successful
        if($isSuccess)
        {
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'result' => $data
            ], $statusCode);
        }else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode
            ], $statusCode);
        }

    }

    /**
     * Send any success response
     *
     * @param string $message
     * @param array|object $data
     * @param int $statusCode
     *
     * @return \Illuminate\Http\Response
     */
    public function success(string $message,  $data, int $statusCode)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    /**
     * Send any error response
     *
     * @param string $message
     * @param int $statusCode
     *
     * @return \Illuminate\Http\Response
     */
    public function error(string $message, int $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }
}