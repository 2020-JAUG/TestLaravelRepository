<?php

namespace App\Traits;

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
    public function coreResponse(string $message, array|object $data = null, int $statusCode, bool $isSuccess = true)
    {
        // Check the params
        if(!$message)
        {
            return response()->json([
                'message' => 'Message is required'
            ]);
        }

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
    public function success(string $message, array|object $data, int $statusCode)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    public function error(string $message, $data = null, int $statusCode, false)
    {

    }
}
