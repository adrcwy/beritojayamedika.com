<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class MediaPath
{
    public static function normalize(?string $path): string
    {
        $path = trim(str_replace('\\', '/', (string) $path));
        $path = preg_replace('#^https?://[^/]+/#i', '', $path) ?? '';
        $path = ltrim($path, '/');

        foreach ([
            'storage/app/public/',
            'app/public/',
            'public/storage/',
            'storage/',
        ] as $prefix) {
            if (str_starts_with($path, $prefix)) {
                $path = substr($path, strlen($prefix));
                break;
            }
        }

        return str_contains($path, '..') ? '' : ltrim($path, '/');
    }

    public static function exists(?string $path): bool
    {
        $path = self::normalize($path);

        return $path !== ''
            && (Storage::disk('public')->exists($path) || is_file(public_path('storage/' . $path)));
    }

    public static function url(?string $path, ?string $fallback = null): string
    {
        if (self::isExternalUrl($path)) {
            return $fallback ?? asset('image/logo.png');
        }

        $path = self::normalize($path);

        if ($path === '' || ! self::exists($path)) {
            return $fallback ?? asset('image/logo.png');
        }

        return url('/media/' . $path);
    }

    public static function data(?string $path, ?string $fallback = null): array
    {
        if (self::isExternalUrl($path)) {
            return [
                'path' => trim((string) $path),
                'url' => $fallback ?? asset('image/logo.png'),
                'available' => false,
            ];
        }

        $path = self::normalize($path);
        $available = $path !== '' && self::exists($path);

        return [
            'path' => $path,
            'url' => $available ? url('/media/' . $path) : ($fallback ?? asset('image/logo.png')),
            'available' => $available,
        ];
    }

    private static function isExternalUrl(?string $path): bool
    {
        return filter_var(trim((string) $path), FILTER_VALIDATE_URL) !== false;
    }
}
