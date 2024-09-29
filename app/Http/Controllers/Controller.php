<?php

namespace App\Http\Controllers;

use App\Factories\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;
use Throwable;

/**
 * @OA\Info(title="Orders API", version="0.0.1")
 */
abstract class Controller
{
    protected function internalErrorResponse(Throwable $e): JsonResponse
    {
        logException($e);
        return response()->json(
            ResponseFactory::make(
                ResponseFactory::ERROR,
                'Erro interno do servidor.',
                Response::HTTP_INTERNAL_SERVER_ERROR,
                [ResponseFactory::INTERNAL_ERROR_MESSAGE]
            ),
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
