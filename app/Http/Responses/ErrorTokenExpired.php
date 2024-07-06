<?php

namespace App\Http\Responses;

class ErrorTokenExpired extends ApiErrorResponse
{
    protected function defaultResponseCode(): int
    {
        return 404;
    }

    protected function defaultErrorMessage(): string
    {
        return 'Токен истек срок.';
    }
}
