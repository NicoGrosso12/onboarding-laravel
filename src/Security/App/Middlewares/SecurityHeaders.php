<?php

declare(strict_types=1);

namespace Lightit\Security\App\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);

        $headers = $response->headers;

        // Prevents the page from being embedded in an iframe to mitigate clickjacking attacks.
        $headers->set('X-Frame-Options', 'DENY');

        // Instructs browsers not to sniff the MIME type to prevent content-type-based attacks.
        $headers->set('X-Content-Type-Options', 'nosniff');

        // Enforces HTTPS by telling the browser to only communicate with the server using HTTPS for the next year (31536000 seconds), including subdomains.
        $headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        // Defines a Content Security Policy (CSP) that restricts resources (e.g., scripts, styles) to only come from the same origin (`self`) to prevent cross-site scripting (XSS) and data injection attacks.
        $headers->set('Content-Security-Policy', "default-src 'self';");

        // Ensures no referrer information is sent with requests, enhancing privacy and preventing leakage of sensitive URLs.
        $headers->set('Referrer-Policy', 'no-referrer');

        return $response;
    }
}
