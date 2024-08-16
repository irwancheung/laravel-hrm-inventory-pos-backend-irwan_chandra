<?php

namespace App\Services;

use Illuminate\Http\Response;

class HttpResponseService
{
    public function http200($message, $data = null)
    {
        return $this->responseJson($message, $data, Response::HTTP_OK);
    }

    public function http201($message, $data = null)
    {
        return $this->responseJson($message, $data, Response::HTTP_CREATED);
    }

    public function http404($message, $data = null)
    {
        return $this->responseJson($message, $data, Response::HTTP_NOT_FOUND);
    }

    public function http401($message, $data = null)
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
