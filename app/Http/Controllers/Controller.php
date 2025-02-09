<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Exception;

abstract class Controller {
    public function handleRequest(callable $callback): JsonResponse
    {
        try {
            return $callback();
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                // 'file' => $e->getFile(),
                // 'line' => $e->getLine()
            ], 500);
        }
    }
}
