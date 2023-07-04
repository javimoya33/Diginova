<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'xxx',
        'pago/paypal',
        'pago/iupay',
        'pago/ceca',
        'pago/tpvredsys',
        'pago/sequraipn',
        'pago/sequraedit',
        'pago/sequraabort',
        'webService',
        'registro',
        'api/*',
];
}
