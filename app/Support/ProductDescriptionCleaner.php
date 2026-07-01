<?php

namespace App\Support;

class ProductDescriptionCleaner
{
    public static function clean(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        $value = html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'UTF-8//IGNORE', $value);
            if ($converted !== false) {
                $value = $converted;
            }
        }

        $value = str_replace(['[object Object]', 'object Object'], '', $value);
        $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value) ?? '';
        $value = preg_replace('/\s*TKDN\s*:\s*(?:\d+(?:[.,]\d+)?|\[[^\]]+\]|[^\s%.]+)?\s*%?\s*\.?\s*Tersedia\s+di\s+Katalog\s+Elektronik\s+Pemerintah\.?/iu', ' ', $value) ?? $value;
        $value = preg_replace('/\s*TKDN\s*:\s*(?:\d+(?:[.,]\d+)?|\[[^\]]+\]|[^\s%.]+)?\s*%?\.?/iu', ' ', $value) ?? $value;
        $value = preg_replace('/\s*Tersedia\s+di\s+Katalog\s+Elektronik\s+Pemerintah\.?/iu', ' ', $value) ?? $value;
        $value = preg_replace('/\s+/', ' ', $value) ?? $value;
        $value = preg_replace('/\s+([.,;:])/', '$1', $value) ?? $value;

        return trim($value);
    }

    public static function looksTruncated(?string $value): bool
    {
        $value = trim((string) $value);

        return $value !== '' && preg_match('/(?:\.{2,}|\x{2026})\s*$/u', $value) === 1;
    }
}
