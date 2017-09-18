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
        'uploadFileILC',
        'uploadFileVendors',
        'uploadFileManufacturer',
        'uploadFileAdmin',
        'uploadFileAttCS',
        'uploadFileClientS',
        'uploadFileILCVendors',
        'uploadFileLaunch',
        'uploadFileProduction',
        'payment',
        'payment/*',
        'logout',
        'login',
        'launch/*',
        'launch_sandbox/*',
        'process',
        'processTestPayment'
    ];
}
