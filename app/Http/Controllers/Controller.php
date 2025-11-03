<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    protected function error(string $message = 'Não encontrado', int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json( ['message' => $message], $status);
    }

    protected function success(string $message, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['message' => $message], $status);
    }

    protected function json(array $data, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $status);
    }
}
