<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Security Headers Middleware
 * 
 * Menambahkan HTTP security headers pada setiap response untuk melindungi
 * dari serangan XSS, Clickjacking, MIME-type sniffing, dll.
 */
class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent Clickjacking — halaman tidak boleh di-embed di iframe situs lain
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Prevent MIME-type sniffing — browser harus patuhi Content-Type header
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // XSS Protection — aktifkan built-in XSS filter browser
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Referrer Policy — hanya kirim origin saat cross-origin
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy — disable fitur browser yang tidak dipakai
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');

        // Strict Transport Security — force HTTPS selama 1 tahun
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        // Content Security Policy — batasi sumber resources
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://unpkg.com https://static.cloudflareinsights.com; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.tailwindcss.com; " .
            "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; " .
            "img-src 'self' data: https: blob:; " .
            "media-src 'self'; " .
            "connect-src 'self' https://cloudflareinsights.com; " .
            "frame-ancestors 'self';"
        );

        return $response;
    }
}
