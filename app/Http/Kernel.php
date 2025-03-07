<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * De globale middleware die op alle HTTP-verzoeken wordt toegepast.
     */
    protected $middleware = [
        // Zorgt ervoor dat de applicatie in onderhoudsmodus kan gaan
        \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // Controleert of verzoeken geldig zijn (en niet via een proxy worden gemanipuleerd)
        \Illuminate\Http\Middleware\ValidatePostSize::class,
        // Voegt standaard beveiligingen toe aan het verzoek
        // \Illuminate\Http\Middleware\TrimStrings::class,
        // \Illuminate\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware-groepen
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Routing\Middleware\ValidateSignature::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class, // CSRF-bescherming voor web
            \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // ✅ Belangrijk voor API-authenticatie!
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Aparte middleware-aliases die kunnen worden gebruikt in routes
     */
    // protected $middlewareAliases = [
    //     'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    //     'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
    //     'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    //     'can' => \Illuminate\Auth\Middleware\Authorize::class,
    //     'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    //     'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    //     'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    //     'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    //     'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // ✅ Sanctum-authenticatie
    // ];
}