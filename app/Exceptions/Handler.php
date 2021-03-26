<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        //dd($this);
        $this->renderable(function (Throwable $e) {
            //dd($this, $e, $e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException, 'errors.'.$e->getStatusCode());
            if ($e instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->route('login')->withErrors(['Su sesión ha expirado']);
            }
            if($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
                return response()->view('errors.'.$e->getStatusCode(), [
                    'exception' => $e
                ], $e->getStatusCode());
            }
        });
    }

}
