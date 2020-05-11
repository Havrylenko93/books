<?php

namespace App\Exceptions;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Log;
use \Illuminate\Auth\AuthenticationException;
use \Illuminate\Auth\Access\AuthorizationException;
use \Symfony\Component\HttpKernel\Exception\HttpException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Illuminate\Validation\ValidationException;

class ApiExceptionHandler extends Handler
{
    /** @var array  */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];
    /** @var ApiExceptionRender  */
    protected $exceptionRender;

    /**
     * ApiExceptionHandler constructor.
     * @param Container $container
     * @param ApiExceptionRender $exceptionRender
     */
    public function __construct(Container $container, ApiExceptionRender $exceptionRender)
    {
        parent::__construct($container);

        $this->exceptionRender = $exceptionRender;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function render($request, \Exception $exception)
    {
        $methodName = camel_case(class_basename($exception));

        if (method_exists($this->exceptionRender, $methodName)) {
            return $this->exceptionRender->{$methodName}($exception, $request);
        } else {
            Log::error($exception->getMessage());

            return redirect('/');
        }
    }
}
