<?php

use App\Domain\Exceptions\{
    BadRequestException,
    ConflictException,
    InternalServerException,
    NotFoundException,
    UnauthorizedException
};
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(fn(Middleware $middleware) => null)
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptionMap = [
            BadRequestException::class        => 400,
            NotFoundException::class          => 404,
            UnauthorizedException::class      => 401,
            ConflictException::class          => 409,
            InternalServerException::class    => 500,
        ];

        foreach ($exceptionMap as $class => $status) {
            $exceptions->render(function (Throwable $e) use ($class, $status) {
                if (get_class($e) === $class) { // <= compara clase exacta, no subclases
                    return response()->json([
                        'message' => $e->getMessage(),
                    ], $status);
                }
                return null;
            });
        }
    })->create();
