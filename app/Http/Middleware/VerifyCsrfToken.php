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
        'app/createBlog/upload',
        'payment-initiate',
        'profile/upload',
        '/profile/upload',
        '/profile',
        'profile',
        '/home/order',
        '/pay-via-ajax-ssl','/home/pay-via-ajax','/success','/cancel','/fail','/ipn',
    ];
}
