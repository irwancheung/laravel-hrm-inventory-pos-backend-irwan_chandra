<?php

namespace App\Services;

use Illuminate\Http\Response;

class HttpResponseService
{
    public function success($message, $data = null)
    {
        return $this->responseJson($message, $data, Response::HTTP_OK);
    }

    public function created($message, $data = null)
    {
        return $this->responseJson($message, $data, Response::HTTP_CREATED);
    }

    public function notFound($message, $data = null)
    {
        return $this->responseJson($message, $data, Response::HTTP_NOT_FOUND);
    }

    public function unauthorized($message, $data = null)
    {
        return $this->responseJson($message, $data, Response::HTTP_UNAUTHORIZED);
    }

    private function responseJson($message, $data = null, $code = Response::HTTP_OK)
    {
        $response = [
            'message' => $message,
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }
}
