<?php

use App\Exceptions\BadRequestException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ServerErrorException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\ValidationException;
use App\Helpers\ApiResponse;
use App\Http\Middleware\ValidateIdParameter;
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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'validate.id' => ValidateIdParameter::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
        if (request()->is('api/*')) {
            $exceptions->render(function (NotFoundException $e) {
                return $e->toResponse();
            });
            $exceptions->render(function (ValidationException $e) {
                return $e->toResponse();
            });
            $exceptions->render(function (BadRequestException $e) {
                return $e->toResponse();
            });
            $exceptions->render(function (ForbiddenException $e) {
                return $e->toResponse();
            });
            $exceptions->render(function (ServerErrorException $e) {
                return $e->toResponse();
            });
            $exceptions->render(function (UnauthorizedException $e) {
                return $e->toResponse();
            });
        }
    })->create();
