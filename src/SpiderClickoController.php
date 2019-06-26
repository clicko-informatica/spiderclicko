<?php

namespace Clicko\SpiderClicko;

use App\Http\Controllers\Controller;
use Request;

class SpiderClickoController extends Controller
{
    public function __construct()
    {
        \App::singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            ClickoExceptionHandler::class
        );
    }
}
