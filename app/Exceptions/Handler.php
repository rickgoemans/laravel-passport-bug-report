<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @inheritdoc
     *
     * Fix "login" route name not defined error on routes not implementing the Authenticate middleware.
     * @see Authenticate
     * @see https://github.com/laravel/passport/issues/1610
     * @see https://github.com/laravel/passport/issues/1598
     */
    protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        if (!$this->shouldReturnJson($request, $exception)) {
            $exception = new AuthenticationException($exception->getMessage(), $exception->guards(), $exception->redirectTo() ?? route('auth.login-form'));
        }

        return parent::unauthenticated($request, $exception);
    }
}
