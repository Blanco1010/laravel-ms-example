<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'error' => 'Token is missing or invalid',
            ], 401);
        });

        $exceptions->renderable(function (ModelNotFoundException $e, $request): JsonResponse {
            return response()->json(['error' => 'Resource not found.'], 404);
        });

        $exceptions->renderable(function (Throwable $e, $request) {
            // Log::error($e . $request->url(), [
            //     'exception' => $e->getMessage()
            // ]);
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        });
    })->create();
