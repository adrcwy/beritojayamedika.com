<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Support\ProductDescriptionCleaner;
use Illuminate\Support\Str;

class AutoScrapeMiddleware
{
    /**
     * INAPROC provider base URL
     */
    private const PROVIDER_BASE = 'https://katalog.inaproc.id/pt-berito-jaya-medika';

    /**
     * Max products to scrape per trigger (keeps it fast)
     */
    private const BATCH_SIZE = 10;

    /**
     * Number of concurrent HTTP requests (workers)
     */
    private const CONCURRENCY = 5;

    /**
     * Category keyword mapping (brand → category_id).
     */
    private array $keywordMapping = [
        'dentsply'       => 71,
        'too care'       => 47,
        'remedi'         => 48,
        'one health'     => 49,
        'ampm'           => 50,
        'sinocare'       => 51,
        'omron'          => 52,
        'life resources' => 53,
        'onemed'         => 54,
        'gea medical'    => 55,
        'general care'   => 56,
        'forsch'         => 57,
        'bsn'            => 58,
        'rusch'          => 59,
        'pahsco'         => 60,
        'terumo'         => 61,
        'jms'            => 62,
        'bd'             => 63,
        'sony'           => 64,
        'riester'        => 65,
        'abn'            => 66,
        'yuwell'         => 67,
        'juara medical'  => 68,
        'core-ray'       => 70,
        'gc'             => 72,
        'osung'          => 73,
        'medin'          => 74,
    ];

    /**
     * Handle — pass through IMMEDIATELY. Zero delay for visitors.
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Terminate — runs AFTER the response is sent to browser.
     * User's page is already loaded. This is completely invisible.
     */
    public function terminate(Request $request, $response): void
    {
        // Guard 1: Only normal page visits
        if (!$request->isMethod('GET') || $request->ajax() || $request->wantsJson()) {
            return;
        }

        // Guard 2: Skip non-page routes
        if ($request->is('admin/*', 'api/*', 'scrape*', 'storage/*', 'login', 'register', 'debug/*')) {
            return;
        }

        // Guard 3: Throttle — max once every 2 hours
        $cacheKey = 'auto_scrape_last_run';
        if (Cache::has($cacheKey)) {
            return;
        }

        // Lock immediately to prevent concurrent runs
        Cache::put($cacheKey, now()->toDateTimeString(), 7200);

        try {
            $this->runAutoScrape();
        } catch (\Exception $e) {
            Log::error('[AutoScrape] Unexpected error: ' . $e->getMessage());
        }
    }

    /**
     * Main scraping logic:
     * 1. Read slug list from JSON
     * 2. Find slugs not yet in database
     * 3. Scrape product detail pages concurrently (5 workers)
     * 4. Save to database
     */
    protected function runAutoScrape(): void
    {
        Log::info('[AutoScrape] Starting (triggered by visitor)...');

        // Step 1: Load slug list
        $slugsPath = storage_path('app/inaproc_slugs.json');
        if (!file_exists($slugsPath)) {
            Log::warning('[AutoScrape] Slug list not found: ' . $slugsPath);
            return;
        }

        $data = json_decode(file_get_contents($slugsPath), true);
        $allSlugs = $data['slugs'] ?? [];

        if (empty($allSlugs)) {
            Log::warning('[AutoScrape] Slug list is empty.');
            return;
        }

        Log::info('[AutoScrape] Loaded ' . count($allSlugs) . ' slugs from JSON.');

        // Step 2: Find which slugs are NOT in database yet
        // Build catalog URLs from slugs
        $existingLinks = Product::pluck('catalog_link')->toArray();
        $existingMap = array_flip($existingLinks);

        $missingSlugBatch = [];
        foreach ($allSlugs as $slug) {
            // Skip inactive products (ending with -X)
            if (str_ends_with($slug, '-X')) {
                continue;
            }

            $catalogUrl = self::PROVIDER_BASE . '/' . $slug;
            if (!isset($existingMap[$catalogUrl])) {
                $missingSlugBatch[] = $slug;
            }

            // Limit batch size
            if (count($missingSlugBatch) >= self::BATCH_SIZE) {
                break;
            }
        }

        if (empty($missingSlugBatch)) {
            Log::info('[AutoScrape] All products already in database. Nothing to scrape.');
            return;
        }

        Log::info('[AutoScrape] Found ' . count($missingSlugBatch) . ' new products to scrape.');

        // Step 3: Scrape concurrently using Http::pool (5 workers)
        $urls = array_map(fn($slug) => self::PROVIDER_BASE . '/' . $slug, $missingSlugBatch);

        $responses = Http::pool(function ($pool) use ($urls) {
            foreach ($urls as $url) {
                $pool->as($url)
                    ->timeout(15)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                        'Accept' => 'text/html,application/xhtml+xml',
                        'Accept-Language' => 'id-ID,id;q=0.9',
                    ])
                    ->get($url);
            }
        });

        // Step 4: Parse responses and save to database
        $savedCount = 0;
        $failedCount = 0;

        foreach ($responses as $url => $response) {
            try {
                if (!$response instanceof \Illuminate\Http\Client\Response || !$response->successful()) {
                    $failedCount++;
                    Log::warning("[AutoScrape] Failed to fetch: $url");
                    continue;
                }

                $html = $response->body();
                $productData = $this->parseProductPage($html, $url);

                if ($productData && !empty($productData['name'])) {
                    // Double-check not already in DB (race condition safety)
                    if (!Product::where('name', $productData['name'])->exists()) {
                        Product::create($productData);
                        $savedCount++;
                        Log::info("[AutoScrape] Saved: {$productData['name']}");
                    }
                } else {
                    $failedCount++;
                    Log::warning("[AutoScrape] Could not parse: $url");
                }
            } catch (\Exception $e) {
                $failedCount++;
                Log::warning("[AutoScrape] Error processing $url: " . $e->getMessage());
            }
        }

        Log::info("[AutoScrape] Complete. Saved: $savedCount | Failed: $failedCount | Remaining: " .
            (count($allSlugs) - count($existingLinks) - $savedCount));
    }

    /**
     * Parse product data from INAPROC detail page HTML.
     * Uses meta tags (og:title, og:description, og:image) which are
     * server-rendered and available without JavaScript.
     */
    protected function parseProductPage(string $html, string $url): ?array
    {
        // Extract og:title → product name
        $name = null;
        if (preg_match('#<meta\s+property="og:title"\s+content="([^"]*)"#i', $html, $m)) {
            $name = $m[1];
            $name = preg_replace('#^Jual\s+#i', '', $name);
            $name = preg_replace('#\s*\|\s*INAPROC.*$#i', '', $name);
            $name = trim($name);
        }

        if (empty($name)) {
            if (preg_match('#<title>([^<]+)</title>#', $html, $m)) {
                $name = preg_replace('#^Jual\s+#i', '', $m[1]);
                $name = preg_replace('#\s*\|\s*INAPROC.*$#i', '', $name);
                $name = trim($name);
            }
        }

        if (empty($name)) return null;

        // ── Extract FULL description from RSC payload ──────────────
        // The RSC data (self.__next_f.push scripts) contains the complete
        // product description, unlike og:description which is truncated.
        $description = '-';

        // Step 1: Collect all RSC script data from the page
        $rscData = '';
        if (preg_match_all('#self\.__next_f\.push\(\[1,"(.+?)"\]\)#s', $html, $rscChunks)) {
            foreach ($rscChunks[1] as $chunk) {
                $rscData .= stripcslashes($chunk);
            }
        }

        // Step 2: Try to extract full description from RSC "description" field
        if (!empty($rscData)) {
            // The RSC data contains: "description":"FULL PRODUCT DESCRIPTION..."
            // This is the complete description, not truncated
            if (preg_match('#"description"\s*:\s*"([^"]{20,})"#', $rscData, $dm)) {
                $fullDesc = stripcslashes($dm[1]);

                // Only use if it's the product description (not meta description)
                // Product descriptions don't contain "INAPROC" or "Katalog Elektronik"
                if (stripos($fullDesc, 'Katalog Elektronik') === false &&
                    stripos($fullDesc, 'Portal resmi') === false) {
                    $description = $fullDesc;
                }
            }
        }

        // Step 3: Clean the description
        if ($description !== '-') {
            $description = ProductDescriptionCleaner::clean($description);
        }

        // Step 4: Fallback to og:description if RSC extraction failed
        if (empty($description) || $description === '-') {
            if (preg_match('#<meta\s+property="og:description"\s+content="([^"]*)"#i', $html, $m)) {
                $description = ProductDescriptionCleaner::clean($m[1]);
                // Remove leading product name duplication
                if (preg_match('#^(.+?)\s*-\s*(.+)$#s', $description, $dm)) {
                    $prefix = trim($dm[1]);
                    $body = trim($dm[2]);
                    if (Str::startsWith($body, $prefix)) {
                        $body = trim(Str::replaceFirst($prefix, '', $body));
                    }
                    $description = !empty($body) ? $body : $prefix;
                }
                $description = ProductDescriptionCleaner::clean($description);
            }
        }

        if (empty($description)) $description = '-';

        // Extract product image from Next/RSC payload first, then OG image.
        $imageUrl = $this->extractImageUrl($html);

        // Download and save image locally
        $imagePath = null;
        if ($imageUrl && ! $this->isBadImageCandidate($imageUrl)) {
            $imagePath = $this->downloadImage($imageUrl, $name);
        }

        return [
            'name'         => $name,
            'description'  => $description,
            'image'        => $imagePath,
            'catalog_link' => $url,
            'category_id'  => $this->guessCategory($name),
        ];
    }

    /**
     * Download product image and save to storage.
     */
    protected function downloadImage(string $imageUrl, string $productName): ?string
    {
        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ])
                ->get($imageUrl);

            if (!$response->successful() || ! str_contains(strtolower((string) $response->header('Content-Type')), 'image/')) {
                return null;
            }

            // Determine extension from URL
            $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
            $filename = 'products/auto_' . Str::slug($productName) . '_' . Str::random(6) . '.' . $extension;

            Storage::disk('public')->put($filename, $response->body());

            return $filename;
        } catch (\Exception $e) {
            Log::warning("[AutoScrape] Image download failed for $productName: " . $e->getMessage());
            return null;
        }
    }

    protected function extractImageUrl(string $html): ?string
    {
        $candidates = [];
        $rscData = '';

        if (preg_match_all('#self\.__next_f\.push\(\[1,"(.+?)"\]\)#s', $html, $chunks)) {
            foreach ($chunks[1] as $chunk) {
                $rscData .= stripcslashes($chunk);
            }
        }

        if ($rscData !== '') {
            preg_match_all('#"imageUrl"\s*:\s*"((?:\\\\.|[^"\\\\])+)\"#', $rscData, $matches);
            foreach ($matches[1] ?? [] as $candidate) {
                $candidates[] = stripcslashes($candidate);
            }
        }

        foreach ([
            '#<meta\s+property="og:image"\s+content="([^"]+)"#i',
            '#<meta\s+name="twitter:image"\s+content="([^"]+)"#i',
        ] as $pattern) {
            if (preg_match($pattern, $html, $match)) {
                $candidates[] = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
        }

        foreach ($candidates as $candidate) {
            $candidate = trim($candidate);

            if (
                filter_var($candidate, FILTER_VALIDATE_URL)
                && !str_contains($candidate, 'logo-katalog')
                && !str_contains($candidate, 'buyer-banner')
                && !str_contains($candidate, 'favicon')
                && ! $this->isBadImageCandidate($candidate)
            ) {
                return $candidate;
            }
        }

        return null;
    }

    protected function isBadImageCandidate(string $url): bool
    {
        $url = rawurldecode(strtolower($url));

        foreach ([
            '404',
            'not-found',
            'notfound',
            'no-image',
            'no_image',
            'placeholder',
            'empty-state',
            'error-page',
            'img-not',
        ] as $needle) {
            if (str_contains($url, $needle)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Guess category_id based on product name using keyword mapping.
     */
    protected function guessCategory(string $productName): ?int
    {
        $nameLower = strtolower(trim($productName));

        foreach ($this->keywordMapping as $keyword => $categoryId) {
            if (strlen($keyword) <= 3) {
                // Short keywords: exact word match only
                if (preg_match('/\b' . preg_quote($keyword, '/') . '\b/i', $nameLower)) {
                    return Category::where('id', $categoryId)->exists() ? $categoryId : null;
                }
            } else {
                if (stripos($nameLower, $keyword) !== false) {
                    return Category::where('id', $categoryId)->exists() ? $categoryId : null;
                }
            }
        }

        return null;
    }
}
