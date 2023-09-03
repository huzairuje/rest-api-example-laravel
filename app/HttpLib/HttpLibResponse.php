<?php

namespace App\HttpLib;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HttpLibResponse extends JsonResponse
{
    public static function success($data = null, $message = '', $code = 200): HttpLibResponse
    {
        $statusText = Response::$statusTexts[$code];
        return new static([
            'status' => $statusText,
            'code' => $code,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    public static function pagination($data = null, $totalCount = 0, $paginationFilter = null, $message = ''): HttpLibResponse
    {
        $code = ResponseAlias::HTTP_OK;
        $statusText = Response::$statusTexts[$code];
        $totalPages = ceil($totalCount / $paginationFilter->size);
        return new static([
            'status' => $statusText,
            'code' => $code,
            'message' => $message,
            'page' => $paginationFilter->page,
            'size' => $paginationFilter->size,
            'totalCount' => $totalCount,
            'totalPages' => $totalPages,
            'data' => $data,
        ], $code);
    }

    public static function error($message = '', $code = 400): HttpLibResponse
    {
        $statusText = Response::$statusTexts[$code];
        return new static([
            'status' => $statusText,
            'code' => $code,
            'data' => null,
            'message' => $message,
        ], $code);
    }

    public static function custom($data = null, $dataError = null, $message = '', $code = 200): HttpLibResponse
    {
        $statusText = Response::$statusTexts[$code];
        return new static([
            'status' => $statusText,
            'code' => $code,
            'data' => $data,
            'message' => $message,
            'dataError' => $dataError,
        ], $code);
    }
}
