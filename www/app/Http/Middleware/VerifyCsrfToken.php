<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'http://localhost/account/registration',
        'http://localhost/account/login',
        'http://localhost/account/contact',
        'http://localhost/games/points',
        'http://localhost/buy'
    ];
}
