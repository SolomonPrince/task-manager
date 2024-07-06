<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Responses\ErrorInternalServerErrorResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Responses\ErrorTooManyAttemptsResponse;
use App\Http\Responses\ErrorUnauthenticatedResponse;
use App\Http\Responses\ErrorValidationResponse;

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
        $exceptions->renderable(function (Throwable $e, Request $request) {
            if($request->is('api/*')) {
                $response = null;

                if($e instanceof HttpResponseException) {
                    return null;
                } elseif($e instanceof AuthenticationException || $e instanceof RouteNotFoundException) {
                    $response = ErrorUnauthenticatedResponse::make();
                } elseif($e instanceof ValidationException) {
                    $response = ErrorValidationResponse::make($e->errors());
                } elseif($e instanceof ThrottleRequestsException) {
                    $response = ErrorTooManyAttemptsResponse::make();
                }

                $errorMessage = config('app.debug')
                    ? $e->getMessage()
                    : '';

                if(! $response) {
                    $response = ErrorInternalServerErrorResponse::make($errorMessage);
                }

                if($response instanceof Response && $e instanceof HttpException) {
                    $headers = $e->getHeaders();
                    $response->headers->add($headers);
                }

                return $response;
            }
            return null;
        });

        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            if ($request->is('api/*')) {
                return true;
            }

            return $request->expectsJson();
        });
    })->create();
