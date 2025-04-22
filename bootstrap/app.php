<?php

use App\Domain\Exceptions\NotFoundException;
use App\Domain\Exceptions\UnauthorizedException;
use App\Domain\Exceptions\ConflictException;
use App\Domain\Exceptions\InternalServerException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundException $e) {
            // Log the error
            Log::error('Not found', [
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'error' => $e->getMessage(),
            ], 404);
        });
        $exceptions->render(function (UnauthorizedException $e) {
            // Log the error
            Log::error('Unauthorized', [
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'error' => $e->getMessage(),
            ], 401);
        });
        $exceptions->render(function (ConflictException $e) {
            // Log the error
            Log::error('Conflict', [
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'error' => $e->getMessage(),
            ], 409);
        });
        $exceptions->render(function (InternalServerException $e) {
            // Log the error
            Log::error('Internal Server Error', [
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        });
    })->create();
