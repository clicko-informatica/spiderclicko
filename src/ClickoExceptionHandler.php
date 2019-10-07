<?php

namespace Clicko\SpiderClicko;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class ClickoExceptionHandler extends ExceptionHandler
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (!$this->noDebeInformar($exception)){
            try{
                ClickoLog::exception($exception);
            } catch (Exception $exception){
                logger('Error al guardar la exception - Clicko Log');
                logger($exception);
            }
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Determina si la excepción está en la lista "no informar".
     *
     * @param  \Exception  $e
     * @return bool
     */
    public function noDebeInformar(Exception $e)
    {
        $noInformar = config('spiderclicko.noInformar');

        return ! is_null(Arr::first($noInformar, function ($tipo) use ($e) {
            return $e instanceof $tipo;
        }));
    }
}
