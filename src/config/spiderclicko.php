<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Listado de tipos excepciones que no se deben informar.
    |--------------------------------------------------------------------------
    */

    'noInformar' => [
        Illuminate\Auth\AuthenticationException::class,
        Illuminate\Auth\Access\AuthorizationException::class,
        Symfony\Component\HttpKernel\Exception\HttpException::class,
        Illuminate\Http\Exceptions\HttpResponseException::class,
        Illuminate\Database\Eloquent\ModelNotFoundException::class,
        Illuminate\Session\TokenMismatchException::class,
        Illuminate\Validation\ValidationException::class,
    ]

];
