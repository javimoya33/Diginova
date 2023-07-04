<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Log;
use Request;
use DB;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
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
        //Log::info("eh ".$exception);
        // [2022-12-04 01:19:01] local.INFO: eh ErrorException: A non well formed numeric value encountered in C:\AplicacionesXgest\servidorweb\htdocs\xwebv7\app\Xgest\Articulo.php:746

        if(str_contains($exception,'ErrorException: A non well formed numeric value encountered in')){
            // ataques por inyeccion de codigo?
            $ipcliente = Request::getClientIp();
            $xxx=DB::select("select count(*) as contador from aaaa_web_bloqueoip where ip=?",[$ipcliente]);
            if($xxx[0]->contador<30){
                DB::insert("insert into aaaa_web_bloqueoip (ip,bloquear) values (?,0)",[$ipcliente]);
            }
        }

        return parent::render($request, $exception);

    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
