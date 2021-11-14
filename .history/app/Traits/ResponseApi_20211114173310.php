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

    }
}