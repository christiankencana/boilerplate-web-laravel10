<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // Custom Code, Rendering 403 and 500 error pages
    public function render($request, Throwable $exception)
    {
        // 403 - Forbidden
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->view('pages/error/403', [], 403);
        }
    
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
    
            // 500 - Internal Server Error
            if ($statusCode == 500) {
                return response()->view('pages/error/500', [], 500);
            }
        }

        return parent::render($request, $exception);
    }
}
