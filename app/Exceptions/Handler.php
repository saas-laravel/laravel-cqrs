<?php

namespace App\Exceptions;

use Core\Exceptions\InternalException;
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
        $this->renderable(function (InternalException $e) {
            $code = $e->getInternalCode();

            return response()->json([
                'status' => 'error',
                'code' => $code->value,
                'message' => $e->getMessage(),
                'description' => $e->getDescription(),
                'link' => $code->getLink(),
            ], $e->getCode());
        });
    }
}
