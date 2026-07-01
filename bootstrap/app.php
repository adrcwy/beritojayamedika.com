<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Security headers pada semua request (global)
        $middleware->append(\App\Http\Middleware\SecurityHeadersMiddleware::class);

        // Auto-scrape INAPROC must not run on normal public traffic in cPanel.
        // Run scraping explicitly from the protected scrape routes or artisan commands.
        if (env('AUTO_SCRAPE_ON_VISIT', false)) {
            $middleware->web(append: [
                \App\Http\Middleware\AutoScrapeMiddleware::class,
            ]);
        }
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
