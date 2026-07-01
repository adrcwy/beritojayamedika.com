<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RemoveBgKeyManager
{
    protected $keysFile = 'removebg_keys.json';
    protected $maxUsagePerKey = 45;
    protected $cooldownDays = 7;

    /**
     * Get all API keys from .env (comma-separated)
     */
    protected function getAllKeys(): array
    {
        $keys = env('REMOVE_BG_API_KEYS', env('REMOVE_BG_API_KEY', ''));
        if (empty($keys)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $keys))));
    }

    /**
     * Load usage tracking data from storage
     */
    protected function loadTracking(): array
    {
        if (!Storage::exists($this->keysFile)) {
            return [];
        }
        return json_decode(Storage::get($this->keysFile), true) ?? [];
    }

    /**
     * Save usage tracking data to storage
     */
    protected function saveTracking(array $data): void
    {
        Storage::put($this->keysFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Get the next available API key
     * Returns null if no keys are available
     */
    public function getAvailableKey(): ?string
    {
        $allKeys = $this->getAllKeys();
        if (empty($allKeys)) {
            Log::warning('[RemoveBg] No API keys configured in .env REMOVE_BG_API_KEYS or REMOVE_BG_API_KEY');
            return null;
        }

        $tracking = $this->loadTracking();
        $now = now();

        foreach ($allKeys as $key) {
            $keyHash = md5($key);

            // Initialize tracking for new key
            if (!isset($tracking[$keyHash])) {
                $tracking[$keyHash] = [
                    'usage' => 0,
                    'first_used_at' => null,
                    'cooldown_until' => null,
                ];
            }

            $keyData = $tracking[$keyHash];

            // Check if key is in cooldown
            if ($keyData['cooldown_until'] && $now->lt($keyData['cooldown_until'])) {
                Log::info("[RemoveBg] Key {$keyHash} in cooldown until {$keyData['cooldown_until']}");
                continue;
            }

            // Reset key if cooldown has passed
            if ($keyData['cooldown_until'] && $now->gte($keyData['cooldown_until'])) {
                $tracking[$keyHash] = [
                    'usage' => 0,
                    'first_used_at' => null,
                    'cooldown_until' => null,
                ];
                $this->saveTracking($tracking);
                Log::info("[RemoveBg] Key {$keyHash} cooldown expired - reset usage");
            }

            // Check if key has remaining usage
            if ($keyData['usage'] < $this->maxUsagePerKey) {
                return $key;
            }

            // Key exhausted - put into cooldown
            $tracking[$keyHash]['cooldown_until'] = $now->addDays($this->cooldownDays)->toDateTimeString();
            $this->saveTracking($tracking);
            Log::info("[RemoveBg] Key {$keyHash} exhausted ({$keyData['usage']}/{$this->maxUsagePerKey}), cooldown set");
        }

        Log::error('[RemoveBg] All API keys exhausted or in cooldown');
        return null;
    }

    /**
     * Record usage of a key
     */
    public function recordUsage(string $key): void
    {
        $tracking = $this->loadTracking();
        $keyHash = md5($key);

        if (!isset($tracking[$keyHash])) {
            $tracking[$keyHash] = [
                'usage' => 0,
                'first_used_at' => null,
                'cooldown_until' => null,
            ];
        }

        $tracking[$keyHash]['usage']++;
        if (!$tracking[$keyHash]['first_used_at']) {
            $tracking[$keyHash]['first_used_at'] = now()->toDateTimeString();
        }

        $this->saveTracking($tracking);
        Log::info("[RemoveBg] Key {$keyHash} usage: {$tracking[$keyHash]['usage']}/{$this->maxUsagePerKey}");
    }

    /**
     * Get status of all keys for monitoring
     */
    public function getStatus(): array
    {
        $allKeys = $this->getAllKeys();
        $tracking = $this->loadTracking();
        $status = [];

        foreach ($allKeys as $index => $key) {
            $keyHash = md5($key);
            $data = $tracking[$keyHash] ?? ['usage' => 0, 'first_used_at' => null, 'cooldown_until' => null];
            $status[] = [
                'key_index' => $index + 1,
                'hash' => substr($keyHash, 0, 8),
                'usage' => $data['usage'],
                'max' => $this->maxUsagePerKey,
                'remaining' => max(0, $this->maxUsagePerKey - $data['usage']),
                'cooldown_until' => $data['cooldown_until'],
                'available' => $data['usage'] < $this->maxUsagePerKey && (!$data['cooldown_until'] || now()->gte($data['cooldown_until'])),
            ];
        }

        return $status;
    }
}
