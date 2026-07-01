<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Product;
use App\Models\Category;
use App\Support\ProductDescriptionCleaner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http as FacadesHttp;
use Illuminate\Support\Facades\Log;

class ScrapeInaprocBulk extends Command
{
    protected $signature = 'scrape:bulk 
                            {--file= : Path ke file teks berisi list URL (satu per baris)}
                            {--urls= : URL langsung, pisahkan dengan koma}
                            {--skip-duplicate : Skip produk yang sudah ada}
                            {--delay=2 : Delay antara request (detik)}
                            {--max=0 : Batas maksimum produk yang discrape (0 untuk semua)}
                            {--auto-category : Otomatis isi kategori berdasarkan nama dan deskripsi produk}
                            {--clean-db : Bersihkan database setelah selesai (hapus TKDN & fix double text)}
                            {--category-from-description : Prioritaskan pencarian kategori dari deskripsi}
                            {--log-file : Simpan log ke file (opsional nama file)}
                            {--min-match-score=50 : Minimum skor untuk match kategori (0-100)}';
    
    protected $description = 'Scrape produk Inaproc secara bulk dari multiple URL';
    
    private $keyManager;
    private $processedCount = 0;
    private $successCount = 0;
    private $failedCount = 0;
    private $skippedCount = 0;
    private $categoryMap = [];
    private $categoryKeywords = [];
    private $autoCategoryEnabled = false;
    private $cleanDbEnabled = false;
    private $categoryFromDescription = false;
    private $logToFile = false;
    private $logFileName = '';
    private $logBuffer = [];
    private $minMatchScore = 50;

    public function __construct()
    {
        parent::__construct();
        $this->keyManager = new \App\Services\RemoveBgKeyManager();
    }

    public function handle()
    {
        $this->autoCategoryEnabled = $this->option('auto-category');
        $this->cleanDbEnabled = $this->option('clean-db');
        $this->categoryFromDescription = $this->option('category-from-description');
        $this->logToFile = $this->option('log-file');
        $this->minMatchScore = (int) $this->option('min-match-score');
        
        // Validasi min match score
        if ($this->minMatchScore < 0 || $this->minMatchScore > 100) {
            $this->error('Min match score harus antara 0-100');
            return 1;
        }
        
        // Setup logging
        $this->setupLogging();
        
        // Log start
        $this->logMessage('===========================================');
        $this->logMessage(' MEMULAI BULK SCRAPING');
        $this->logMessage('===========================================');
        
        // Load kategori dari database untuk mapping
        if ($this->autoCategoryEnabled) {
            $this->loadCategoryData();
        }
        
        $urls = $this->getUrls();
        
        if (empty($urls)) {
            $this->error('Tidak ada URL yang ditemukan!');
            $this->info('Cara penggunaan:');
            $this->info('  php artisan scrape:bulk --file=path/to/urls.txt');
            $this->info('  php artisan scrape:bulk --urls="https://...,https://..."');
            $this->info('  php artisan scrape:bulk --file=urls.txt --delay=3 --skip-duplicate --auto-category --clean-db --category-from-description --min-match-score=60');
            $this->logMessage('ERROR: Tidak ada URL yang ditemukan', 'error');
            return 1;
        }

        $totalUrls = count($urls);
        $maxProcess = $this->option('max') > 0 ? min($this->option('max'), $totalUrls) : $totalUrls;
        
        $this->info("===========================================");
        $this->info(" MEMULAI BULK SCRAPING");
        $this->info(" Total URL ditemukan: $totalUrls");
        $this->info(" Akan diproses: " . ($maxProcess == $totalUrls ? "Semua" : $maxProcess));
        $this->info(" Delay: " . $this->option('delay') . " detik");
        $this->info(" Skip duplicate: " . ($this->option('skip-duplicate') ? 'Ya' : 'Tidak'));
        $this->info(" Auto category: " . ($this->autoCategoryEnabled ? 'Ya' : 'Tidak'));
        $this->info(" Cari kategori dari deskripsi: " . ($this->categoryFromDescription ? 'Ya (Prioritas)' : 'Opsional'));
        $this->info(" Min match score: " . $this->minMatchScore);
        $this->info(" Clean DB setelah selesai: " . ($this->cleanDbEnabled ? 'Ya' : 'Tidak'));
        $this->info(" Logging: " . ($this->logToFile ? 'Aktif' : 'Standar'));
        
        if ($this->autoCategoryEnabled) {
            $this->info(" Kategori ditemukan: " . count($this->categoryMap));
            $this->info(" Keyword kategori: " . count($this->categoryKeywords));
        }
        $this->info("===========================================");
        
        // Log configuration
        $this->logMessage("Konfigurasi:", 'info');
        $this->logMessage("Total URL ditemukan: $totalUrls", 'info');
        $this->logMessage("Akan diproses: " . ($maxProcess == $totalUrls ? "Semua" : $maxProcess), 'info');
        $this->logMessage("Min match score: " . $this->minMatchScore, 'info');
        
        $this->newLine();
        
        $progressBar = $this->output->createProgressBar($maxProcess);
        $progressBar->start();

        foreach ($urls as $index => $url) {
            if ($this->processedCount >= $maxProcess) {
                break;
            }
            
            $this->processedCount++;
            
            // Bersihkan URL
            $url = trim($url);
            if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
                $this->failedCount++;
                $this->warn("  URL tidak valid: $url");
                $this->logMessage("URL tidak valid: $url", 'warning');
                $progressBar->advance();
                continue;
            }
            
            $this->info("  [$this->processedCount/$maxProcess] Memproses: " . Str::limit($url, 70));
            $this->logMessage("[$this->processedCount/$maxProcess] Memproses: $url", 'info');
            
            // Proses scraping
            $result = $this->scrapeSingleUrl($url);
            
            if ($result === 'success') {
                $this->successCount++;
                $this->info("    [OK] Berhasil");
                $this->logMessage("[OK] Berhasil scrape: $url", 'success');
            } elseif ($result === 'skipped') {
                $this->skippedCount++;
                $this->warn("    [SKIP] Dilewati (duplikat)");
                $this->logMessage("[SKIP] Dilewati (duplikat): $url", 'warning');
            } else {
                $this->failedCount++;
                $this->error("    [FAIL] Gagal: " . $result);
                $this->logMessage("[FAIL] Gagal: $url - Error: $result", 'error');
            }
            
            // Delay antar request untuk menghindari rate limit
            if ($index < count($urls) - 1 && $this->option('delay') > 0) {
                sleep($this->option('delay'));
            }
            
            $progressBar->advance();
            
            // Tambah newline untuk progress bar yang panjang
            if ($this->processedCount % 5 == 0) {
                $this->newLine();
            }
        }
        
        $progressBar->finish();
        $this->newLine(2);
        
        // Jalankan clean database jika diaktifkan
        if ($this->cleanDbEnabled && $this->successCount > 0) {
            $this->cleanDatabase();
        }
        
        // Tampilkan summary
        $this->showSummary();
        
        // Log hasil scraping
        $this->logResult();
        
        // Save log to file if enabled
        if ($this->logToFile) {
            $this->saveLogToFile();
        }
        
        return 0;
    }
    
    /**
     * Setup logging configuration
     */
    private function setupLogging(): void
    {
        if ($this->logToFile) {
            $this->logFileName = 'scrape_log_' . date('Y-m-d_H-i-s') . '.txt';
            $this->logMessage("Logging diaktifkan. File: " . $this->logFileName, 'info');
        }
        
        // Ensure log channel exists
        $this->ensureLogChannel();
    }
    
    /**
     * Ensure scraping log channel exists
     */
    private function ensureLogChannel(): void
    {
        $logConfig = config('logging.channels');
        
        if (!isset($logConfig['scraping'])) {
            config(['logging.channels.scraping' => [
                'driver' => 'single',
                'path' => storage_path('logs/scraping.log'),
                'level' => 'info',
            ]]);
        }
    }
    
    /**
     * Log message to multiple destinations
     */
    private function logMessage(string $message, string $type = 'info'): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[$timestamp] [$type] $message";
        
        // Store in buffer
        $this->logBuffer[] = $formattedMessage;
        
        // Log to Laravel log channel
        try {
            switch ($type) {
                case 'error':
                    Log::channel('scraping')->error($message);
                    break;
                case 'warning':
                    Log::channel('scraping')->warning($message);
                    break;
                case 'success':
                    Log::channel('scraping')->info($message);
                    break;
                default:
                    Log::channel('scraping')->info($message);
                    break;
            }
        } catch (\Exception $e) {
            // Fallback to default log
            Log::error("Failed to log to scraping channel: " . $e->getMessage());
            Log::info($message);
        }
    }
    
    /**
     * Save log buffer to file
     */
    private function saveLogToFile(): void
    {
        try {
            $logDir = storage_path('logs/scraping');
            
            // Create directory if not exists
            if (!file_exists($logDir)) {
                mkdir($logDir, 0755, true);
            }
            
            $filePath = $logDir . '/' . $this->logFileName;
            
            // Add header
            $logContent = "===========================================\n";
            $logContent .= " SCRAPING LOG - " . date('Y-m-d H:i:s') . "\n";
            $logContent .= "===========================================\n\n";
            $logContent .= "Command: " . implode(' ', $_SERVER['argv']) . "\n";
            $logContent .= "Timestamp: " . date('Y-m-d H:i:s') . "\n";
            $logContent .= "Memory Usage: " . memory_get_usage(true) / 1024 / 1024 . " MB\n";
            $logContent .= "===========================================\n\n";
            
            // Add all log messages
            foreach ($this->logBuffer as $logEntry) {
                $logContent .= $logEntry . "\n";
            }
            
            // Add summary
            $logContent .= "\n===========================================\n";
            $logContent .= " SUMMARY\n";
            $logContent .= "===========================================\n";
            $logContent .= "Total Processed: " . $this->processedCount . "\n";
            $logContent .= "Success: " . $this->successCount . "\n";
            $logContent .= "Skipped: " . $this->skippedCount . "\n";
            $logContent .= "Failed: " . $this->failedCount . "\n";
            $logContent .= "Execution Time: " . (microtime(true) - LARAVEL_START) . " seconds\n";
            
            file_put_contents($filePath, $logContent);
            
            $this->info("Log disimpan ke: " . $filePath);
            $this->logMessage("Log file saved: " . $filePath, 'info');
            
        } catch (\Exception $e) {
            $this->error("Gagal menyimpan log file: " . $e->getMessage());
            $this->logMessage("Failed to save log file: " . $e->getMessage(), 'error');
        }
    }
    
    /**
     * Load data kategori dari database
     */
    private function loadCategoryData(): void
    {
        try {
            $categories = Category::all(['id', 'name', 'slug']);
            
            foreach ($categories as $category) {
                // Simpan mapping untuk nama dan slug
                $this->categoryMap[strtolower($category->name)] = $category->id;
                $this->categoryMap[strtolower($category->slug)] = $category->id;
                
                // Tambahkan variasi nama untuk matching
                $variations = $this->generateNameVariations($category->name);
                foreach ($variations as $variation) {
                    $this->categoryMap[strtolower($variation)] = $category->id;
                }
                
                // Buat array keyword untuk pencarian dalam deskripsi
                $this->categoryKeywords[$category->id] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'keywords' => $this->generateCategoryKeywords($category->name, $category->slug),
                    'priority' => $this->calculateCategoryPriority($category->name)
                ];
            }
            
            $this->info("  Loaded " . count($this->categoryMap) . " kategori mapping entries");
            $this->info("  Loaded " . count($this->categoryKeywords) . " kategori dengan keywords");
            $this->logMessage("Loaded " . count($this->categoryMap) . " kategori mapping entries", 'info');
            
        } catch (\Exception $e) {
            $this->error("  Error loading category data: " . $e->getMessage());
            $this->logMessage("Error loading category data: " . $e->getMessage(), 'error');
        }
    }
    
    /**
     * Generate keywords untuk pencarian dalam deskripsi
     */
    private function generateCategoryKeywords(string $name, string $slug): array
    {
        $keywords = [];
        
        // Tambahkan nama asli
        $keywords[] = strtolower($name);
        
        // Tambahkan slug
        $keywords[] = strtolower($slug);
        
        // Untuk brand, tambahkan kata "brand" dan "merk"
        if ($this->isBrandName($name)) {
            $keywords[] = strtolower($name) . ' brand';
            $keywords[] = strtolower($name) . ' merk';
            $keywords[] = 'merk ' . strtolower($name);
            $keywords[] = 'produk ' . strtolower($name);
        }
        
        // Split multi-word names
        $words = explode(' ', strtolower($name));
        if (count($words) > 1) {
            $keywords[] = implode('', $words); // Tanpa spasi
            $keywords[] = implode('-', $words); // Dengan dash
        }
        
        // Tambahkan sinonim umum untuk kategori medis
        $medicalSynonyms = $this->getMedicalSynonyms();
        foreach ($medicalSynonyms as $synonym) {
            if (stripos($name, $synonym) !== false) {
                $keywords[] = $synonym;
            }
        }
        
        return array_unique(array_filter($keywords));
    }
    
    /**
     * Cek apakah nama termasuk brand
     */
    private function isBrandName(string $name): bool
    {
        $brandNames = [
            'dentsply', 'omron', 'sinocare', 'terumo', 'sony', 'bd',
            'gea', 'juara', 'yuwell', 'riester', 'core-ray', 'gc',
            'forsch', 'bsn', 'rusch', 'pahsco', 'jms', 'abn'
        ];
        
        $nameLower = strtolower($name);
        foreach ($brandNames as $brand) {
            if (strpos($nameLower, $brand) !== false) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Dapatkan sinonim untuk kategori medis
     */
    private function getMedicalSynonyms(): array
    {
        return [
            'alat kesehatan', 'alat medis', 'medical device',
            'peralatan rumah sakit', 'healthcare', 'kesehatan',
            'medis', 'klinik', 'rumah sakit', 'dokter', 'perawat',
            'diagnostik', 'terapi', 'pengobatan', 'alat bantu',
            'disposable', 'steril', 'sanitasi', 'hygiene'
        ];
    }
    
    /**
     * Hitung priority untuk kategori
     */
    private function calculateCategoryPriority(string $name): int
    {
        $priority = 1; // Default priority
        
        // Brand terkenal dapat priority lebih tinggi
        $highPriorityBrands = ['dentsply', 'omron', 'terumo', 'bd', 'sony'];
        foreach ($highPriorityBrands as $brand) {
            if (stripos($name, $brand) !== false) {
                $priority = 3;
                break;
            }
        }
        
        // Kategori medis umum priority menengah
        $medicalKeywords = ['medical', 'care', 'health', 'medis', 'kesehatan'];
        foreach ($medicalKeywords as $keyword) {
            if (stripos($name, $keyword) !== false) {
                $priority = max($priority, 2);
                break;
            }
        }
        
        return $priority;
    }
    
    /**
     * Cari kategori berdasarkan nama dan deskripsi produk
     */
    private function findCategoryId(string $productName, string $description = ''): ?int
    {
        if (!$this->autoCategoryEnabled) {
            return null;
        }
        
        $foundCategoryId = null;
        $maxScore = 0;
        $bestMatchCategory = null;
        
        // Langkah 1: Cari kategori dari deskripsi (jika diaktifkan)
        if (!empty($description) && ($this->categoryFromDescription || empty($foundCategoryId))) {
            $descriptionLower = strtolower($description);
            $this->logMessage("Mencari kategori dari deskripsi untuk: " . Str::limit($productName, 30), 'debug');
            
            foreach ($this->categoryKeywords as $categoryData) {
                $score = $this->calculateDescriptionMatchScore($descriptionLower, $categoryData);
                
                if ($score > $maxScore) {
                    $maxScore = $score;
                    $foundCategoryId = $categoryData['id'];
                    $bestMatchCategory = $categoryData['name'];
                    
                    if ($score >= $this->minMatchScore) { // Gunakan threshold configurable
                        $category = Category::find($categoryData['id']);
                        $this->logMessage("Kategori ditemukan dari deskripsi: {$category->name} (Score: {$score})", 'success');
                        return $foundCategoryId;
                    }
                }
            }
        }
        
        // Langkah 2: Cari kategori dari nama produk dengan EXACT MATCH terlebih dahulu
        $productNameLower = strtolower(trim($productName));
        $this->logMessage("Mencari kategori dari nama produk: " . Str::limit($productName, 30), 'debug');
        
        // Cek EXACT MATCH di keyword mapping khusus
        $keywordMapping = [
            'dentsply' => 71,
            'too care' => 47,
            'remedi' => 48,
            'one health' => 49,
            'ampm' => 50,
            'sinocare' => 51,
            'omron' => 52,
            'life resources' => 53,
            'onemed' => 54,
            'gea medical' => 55,
            'general care' => 56,
            'forsch' => 57,
            'bsn' => 58,
            'rusch' => 59,
            'pahsco' => 60,
            'terumo' => 61,
            'jms' => 62,
            'bd' => 63,
            'sony' => 64,
            'riester' => 65,
            'abn' => 66,
            'yuwell' => 67,
            'juara medical' => 68,
            'core-ray' => 70,
            'gc' => 72,
            'osung' => 73,
            'medin' => 74,
        ];
        
        // PERBAIKAN: Cek exact match dulu, bukan contains
        $productWords = explode(' ', $productNameLower);
        foreach ($keywordMapping as $keyword => $categoryId) {
            $keywordLower = strtolower($keyword);
            
            // Cek apakah keyword muncul sebagai kata terpisah (exact word match)
            foreach ($productWords as $word) {
                if ($word === $keywordLower) {
                    $category = Category::find($categoryId);
                    if ($category) {
                        $this->logMessage("EXACT MATCH ditemukan: '{$keyword}' → {$category->name} (ID: {$categoryId})", 'success');
                        return $categoryId;
                    }
                }
            }
            
            // Cek contains match HANYA untuk kata yang panjang (>3 karakter)
            if (strlen($keywordLower) > 3 && strpos($productNameLower, $keywordLower) !== false) {
                $category = Category::find($categoryId);
                if ($category) {
                    $this->logMessage("CONTAINS MATCH ditemukan: '{$keyword}' → {$category->name} (ID: {$categoryId})", 'success');
                    return $categoryId;
                }
            }
        }
        
        // Langkah 3: Cek di category map dengan logika yang lebih ketat
        foreach ($this->categoryMap as $categoryKey => $categoryId) {
            if ($this->strictMatchesCategory($productNameLower, $categoryKey)) {
                $category = Category::find($categoryId);
                if ($category) {
                    $this->logMessage("STRICT MATCH ditemukan dari mapping: {$category->name} (ID: {$categoryId})", 'success');
                    return $categoryId;
                }
            }
        }
        
        // Langkah 4: Jika belum ditemukan, gunakan hasil dari deskripsi HANYA jika score cukup tinggi
        if ($foundCategoryId && $maxScore >= $this->minMatchScore) {
            $category = Category::find($foundCategoryId);
            $this->logMessage("Kategori dipilih dari deskripsi (Score: {$maxScore}): {$category->name}", 'warning');
            return $foundCategoryId;
        }
        
        // Langkah 5: Jika score dari deskripsi rendah, return null (tidak ada kategori)
        if ($foundCategoryId && $maxScore > 0 && $maxScore < $this->minMatchScore) {
            $this->logMessage("Kategori ditemukan tapi score terlalu rendah: {$bestMatchCategory} (Score: {$maxScore} < {$this->minMatchScore})", 'warning');
        }
        
        $this->logMessage("Tidak ditemukan kategori untuk: " . Str::limit($productName, 50), 'warning');
        return null;
    }
    
    /**
     * STRICT Matching antara produk dan kategori
     * Hanya match jika keyword muncul sebagai kata terpisah atau contains dengan confidence tinggi
     */
    private function strictMatchesCategory(string $productName, string $categoryKey): bool
    {
        // Skip jika keyword terlalu pendek (bisa jadi false positive)
        if (strlen($categoryKey) < 4) {
            return false;
        }
        
        // Exact word match (kata terpisah)
        $productWords = explode(' ', $productName);
        foreach ($productWords as $word) {
            if ($word === $categoryKey) {
                return true;
            }
        }
        
        // Contains match dengan confidence check
        if (strpos($productName, $categoryKey) !== false) {
            // Untuk brand names, kita lebih strict
            $brandNames = ['dentsply', 'omron', 'sinocare', 'terumo', 'bd', 'sony'];
            if (in_array($categoryKey, $brandNames)) {
                // Untuk brand, hanya terima jika muncul sebagai kata utuh
                $pattern = '/\b' . preg_quote($categoryKey, '/') . '\b/i';
                return preg_match($pattern, $productName) === 1;
            }
            
            // Untuk non-brand, cek apakah tidak terlalu umum
            $commonWords = ['care', 'medical', 'health', 'general', 'one'];
            if (!in_array($categoryKey, $commonWords)) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Hitung skor match antara deskripsi dan kategori
     */
    private function calculateDescriptionMatchScore(string $description, array $categoryData): float
    {
        $score = 0;
        $descriptionLength = strlen($description);
        
        if ($descriptionLength < 20) { // Minimal 20 karakter untuk deskripsi
            return 0;
        }
        
        // Cek setiap keyword
        foreach ($categoryData['keywords'] as $keyword) {
            $keyword = strtolower(trim($keyword));
            if (strlen($keyword) < 3) continue;
            
            // Hitung frekuensi keyword dalam deskripsi dengan word boundary
            $pattern = '/\b' . preg_quote($keyword, '/') . '\b/i';
            preg_match_all($pattern, $description, $matches);
            $count = count($matches[0]);
            
            if ($count > 0) {
                // Base score berdasarkan frekuensi
                $baseScore = $count * 15; // Lebih tinggi untuk exact match
                
                // Bonus untuk keyword yang lebih spesifik
                $specificityBonus = min(strlen($keyword) * 0.8, 25);
                
                // Bonus untuk brand names
                $brandBonus = $this->isBrandName($categoryData['name']) ? 20 : 0;
                
                // Total score untuk keyword ini
                $keywordScore = $baseScore + $specificityBonus + $brandBonus;
                
                $score += $keywordScore;
                
                // Debug logging
                if ($count > 0) {
                    $this->logMessage("Keyword '{$keyword}': {$count}x = {$keywordScore} points", 'debug');
                }
            }
        }
        
        // Tambahkan priority bonus
        $score += $categoryData['priority'] * 3; // Kurangi bonus priority
        
        // Normalisasi score
        $score = min($score, 100);
        
        // Apply minimum threshold multiplier
        if ($score > 0 && $score < $this->minMatchScore) {
            $score = $score * 0.8; // Kurangi score jika di bawah threshold
        }
        
        return $score;
    }
    
    /**
     * Matching yang lebih cerdas antara produk dan kategori
     */
    private function matchesCategory(string $productName, string $categoryKey): bool
    {
        // Exact match
        if ($productName === $categoryKey) {
            return true;
        }
        
        // Contains match (case insensitive)
        if (strpos($productName, $categoryKey) !== false) {
            return true;
        }
        
        // Word boundary match (regex)
        $pattern = '/\b' . preg_quote($categoryKey, '/') . '\b/i';
        if (preg_match($pattern, $productName)) {
            return true;
        }
        
        // Untuk kategori satu kata, cek apakah muncul sebagai kata terpisah
        if (str_word_count($categoryKey) === 1) {
            $words = explode(' ', $productName);
            foreach ($words as $word) {
                if (strtolower($word) === $categoryKey) {
                    return true;
                }
            }
        }
        
        // Untuk kategori dengan multiple words, cek partial match
        if (str_word_count($categoryKey) > 1) {
            $categoryWords = explode(' ', $categoryKey);
            $allWordsMatch = true;
            foreach ($categoryWords as $categoryWord) {
                if (strlen($categoryWord) > 2 && strpos($productName, $categoryWord) === false) {
                    $allWordsMatch = false;
                    break;
                }
            }
            if ($allWordsMatch) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Generate variasi nama untuk matching yang lebih baik
     */
    private function generateNameVariations(string $name): array
    {
        $variations = [];
        
        // Original
        $variations[] = $name;
        
        // Without spaces
        $variations[] = str_replace(' ', '', $name);
        
        // With dash instead of space
        $variations[] = str_replace(' ', '-', $name);
        
        // With underscore instead of space
        $variations[] = str_replace(' ', '_', $name);
        
        // Uppercase
        $variations[] = strtoupper($name);
        
        // Lowercase
        $variations[] = strtolower($name);
        
        // Title case
        $variations[] = ucwords(strtolower($name));
        
        // Remove special characters
        $variations[] = preg_replace('/[^a-zA-Z0-9]/', '', $name);
        
        // Remove special characters and lowercase
        $variations[] = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $name));
        
        // Untuk nama yang mengandung "Medical" atau "Care", buat versi tanpa kata tersebut
        if (stripos($name, 'medical') !== false) {
            $variations[] = trim(str_ireplace('medical', '', $name));
            $variations[] = trim(str_ireplace('medical', '', $name)) . ' Medical';
        }
        
        if (stripos($name, 'care') !== false) {
            $variations[] = trim(str_ireplace('care', '', $name));
            $variations[] = trim(str_ireplace('care', '', $name)) . ' Care';
        }
        
        return array_unique($variations);
    }
    
    /**
     * Bersihkan database setelah selesai scraping
     */
    private function cleanDatabase(): void
    {
        $this->info("===========================================");
        $this->info(" MEMBERSIHKAN DATABASE");
        $this->info("===========================================");
        $this->logMessage('===========================================', 'info');
        $this->logMessage('MEMBERSIHKAN DATABASE', 'info');
        $this->logMessage('===========================================', 'info');
        
        try {
            // Langkah 1: Hapus teks TKDN
            $this->info("  Langkah 1: Menghapus teks TKDN...");
            $this->logMessage("Langkah 1: Menghapus teks TKDN...", 'info');
            
            $tkdnPattern = 'TKDN: 0%. Tersedia di Katalog Elektronik Pemerintah.';
            
            $tkdnCount = DB::table('products')
                ->where('description', 'LIKE', '%' . $tkdnPattern . '%')
                ->count();
                
            if ($tkdnCount > 0) {
                $affected = DB::table('products')
                    ->where('description', 'LIKE', '%' . $tkdnPattern . '%')
                    ->update([
                        'description' => DB::raw("TRIM(REPLACE(description, '$tkdnPattern', ''))"),
                        'updated_at' => now()
                    ]);
                    
                $this->info("    [OK] $affected produk diperbarui (hapus TKDN)");
                $this->logMessage("$affected produk diperbarui (hapus TKDN)", 'success');
            } else {
                $this->info("    [OK] Tidak ada produk dengan teks TKDN");
                $this->logMessage("Tidak ada produk dengan teks TKDN", 'info');
            }
            
            // Langkah 2: Perbaiki pola double text "A - A ..."
            $this->info("  Langkah 2: Memperbaiki pola double text...");
            $this->logMessage("Langkah 2: Memperbaiki pola double text...", 'info');
            
            $doubleTextCount = DB::table('products')
                ->whereRaw("description LIKE '% - %'")
                ->whereRaw("SUBSTRING_INDEX(description, ' - ', 1) = SUBSTRING_INDEX(SUBSTRING_INDEX(description, ' - ', 2), ' - ', -1)")
                ->count();
                
            if ($doubleTextCount > 0) {
                $affected = DB::table('products')
                    ->whereRaw("description LIKE '% - %'")
                    ->whereRaw("SUBSTRING_INDEX(description, ' - ', 1) = SUBSTRING_INDEX(SUBSTRING_INDEX(description, ' - ', 2), ' - ', -1)")
                    ->update([
                        'description' => DB::raw("TRIM(SUBSTRING(description, LENGTH(SUBSTRING_INDEX(description, ' - ', 1)) + 4))"),
                        'updated_at' => now()
                    ]);
                    
                $this->info("    [OK] $affected produk diperbarui (perbaiki double text)");
                $this->logMessage("$affected produk diperbarui (perbaiki double text)", 'success');
            } else {
                $this->info("    [OK] Tidak ada produk dengan pola double text");
                $this->logMessage("Tidak ada produk dengan pola double text", 'info');
            }
            
            // Langkah 3: Update kategori berdasarkan deskripsi untuk produk yang belum punya kategori
            // TAPI HANYA jika score cukup tinggi
            if ($this->autoCategoryEnabled) {
                $this->info("  Langkah 3: Update kategori dari deskripsi untuk produk tanpa kategori (min score: {$this->minMatchScore})...");
                $this->logMessage("Langkah 3: Update kategori dari deskripsi untuk produk tanpa kategori (min score: {$this->minMatchScore})...", 'info');
                
                $productsWithoutCategory = Product::whereNull('category_id')
                    ->orWhere('category_id', 0)
                    ->get();
                    
                $updatedCount = 0;
                $skippedCount = 0;
                
                foreach ($productsWithoutCategory as $product) {
                    if (!empty($product->description) && $product->description !== '-') {
                        $categoryId = $this->findCategoryId($product->name, $product->description);
                        
                        if ($categoryId) {
                            $product->category_id = $categoryId;
                            $product->save();
                            $updatedCount++;
                            $this->logMessage("Produk ID {$product->id} mendapatkan kategori ID {$categoryId}", 'success');
                        } else {
                            $skippedCount++;
                        }
                    }
                }
                
                if ($updatedCount > 0) {
                    $this->info("    [OK] $updatedCount produk mendapatkan kategori dari deskripsi");
                    $this->logMessage("$updatedCount produk mendapatkan kategori dari deskripsi", 'success');
                }
                if ($skippedCount > 0) {
                    $this->info("    [WARN] $skippedCount produk tidak mendapatkan kategori (score terlalu rendah)");
                    $this->logMessage("$skippedCount produk tidak mendapatkan kategori (score terlalu rendah)", 'warning');
                }
                if ($updatedCount === 0 && $skippedCount === 0) {
                    $this->info("    [OK] Tidak ada produk yang perlu diupdate kategori");
                    $this->logMessage("Tidak ada produk yang perlu diupdate kategori", 'info');
                }
            }
            
            // Langkah 4: Clean up whitespace dan karakter khusus
            $this->info("  Langkah 4: Membersihkan whitespace dan karakter khusus...");
            $this->logMessage("Langkah 4: Membersihkan whitespace dan karakter khusus...", 'info');
            
            try {
                $affected = DB::table('products')
                    ->update([
                        'description' => DB::raw("TRIM(description)"),
                        'updated_at' => now()
                    ]);
                    
                $this->info("    [OK] Semua produk dibersihkan dari whitespace berlebih");
                $this->logMessage("Semua produk dibersihkan dari whitespace berlebih", 'success');
            } catch (\Exception $e) {
                $this->info("    [WARN] Gagal membersihkan whitespace: " . $e->getMessage());
                $this->logMessage("Gagal membersihkan whitespace: " . $e->getMessage(), 'error');
            }
            
            // Statistik pembersihan
            $totalProducts = Product::count();
            $withCategory = Product::whereNotNull('category_id')->where('category_id', '!=', 0)->count();
            $withoutCategory = $totalProducts - $withCategory;
            
            $this->info("  Statistik setelah pembersihan:");
            $this->info("    Total produk: $totalProducts");
            $this->info("    Dengan kategori: $withCategory");
            $this->info("    Tanpa kategori: $withoutCategory");
            
            $this->logMessage("Statistik setelah pembersihan:", 'info');
            $this->logMessage("Total produk: $totalProducts", 'info');
            $this->logMessage("Dengan kategori: $withCategory", 'info');
            $this->logMessage("Tanpa kategori: $withoutCategory", 'info');
            
            $this->info("===========================================");
            $this->info(" [OK] PEMBERSIHAN DATABASE SELESAI");
            $this->info("===========================================");
            
            $this->logMessage('===========================================', 'info');
            $this->logMessage('PEMBERSIHAN DATABASE SELESAI', 'success');
            $this->logMessage('===========================================', 'info');
            
        } catch (\Exception $e) {
            $this->error("  [ERROR] Error saat membersihkan database: " . $e->getMessage());
            $this->logMessage("Error saat membersihkan database: " . $e->getMessage(), 'error');
            $this->logMessage("Trace: " . $e->getTraceAsString(), 'error');
            
            Log::error('Clean database error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
    
    /**
     * Mendapatkan list URL dari berbagai sumber
     */
    private function getUrls(): array
    {
        $urls = [];
        
        // Ambil dari file
        if ($this->option('file')) {
            $filePath = $this->option('file');
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);
                $urls = array_filter(explode("\n", $content), function($url) {
                    return !empty(trim($url));
                });
                $this->logMessage("Loaded " . count($urls) . " URLs from file: $filePath", 'info');
            } else {
                $this->error("File tidak ditemukan: $filePath");
                $this->logMessage("File tidak ditemukan: $filePath", 'error');
            }
        }
        
        // Ambil dari parameter langsung
        if ($this->option('urls')) {
            $directUrls = explode(',', $this->option('urls'));
            $directUrls = array_filter($directUrls, function($url) {
                return !empty(trim($url));
            });
            $urls = array_merge($urls, $directUrls);
            $this->logMessage("Loaded " . count($directUrls) . " URLs from command parameter", 'info');
        }
        
        // Jika tidak ada parameter, coba baca dari input interaktif
        if (empty($urls) && !$this->option('no-interaction')) {
            $this->info("Masukkan URL (satu per baris, ketik 'END' untuk selesai):");
            $this->logMessage("Meminta input URL interaktif", 'info');
            while (true) {
                $input = $this->ask("URL " . (count($urls) + 1) . ":");
                if (strtoupper($input) === 'END' || empty(trim($input))) {
                    break;
                }
                $urls[] = trim($input);
            }
        }
        
        // Hapus duplikat
        $originalCount = count($urls);
        $urls = array_unique($urls);
        $duplicateCount = $originalCount - count($urls);
        
        if ($duplicateCount > 0) {
            $this->logMessage("Removed $duplicateCount duplicate URLs", 'info');
        }
        
        $this->logMessage("Total unique URLs to process: " . count($urls), 'info');
        
        return array_values($urls);
    }
    
    /**
     * Scrape single URL
     */
    private function scrapeSingleUrl(string $url): string
    {
        try {
            $this->logMessage("Memulai scrape untuk URL: $url", 'info');
            
            $this->info("    Membuka URL...");
            $response = Http::timeout(30)->get($url);
            
            if ($response->failed()) {
                $errorMsg = "Gagal membuka URL (Status: " . $response->status() . ")";
                $this->logMessage($errorMsg, 'error');
                return $errorMsg;
            }
            
            $html = $response->body();
            $crawler = new Crawler($html);
            
            // Ambil nama produk
            try {
                $name = trim($crawler->filter('h1')->first()->text());
                $this->logMessage("Nama produk ditemukan: " . Str::limit($name, 50), 'info');
            } catch (\Exception $e) {
                $errorMsg = "Nama produk tidak ditemukan";
                $this->logMessage($errorMsg, 'error');
                return $errorMsg;
            }
            
            $this->info("    Nama: " . Str::limit($name, 50));
            
            // Ambil deskripsi
            $desc = $this->extractDescription($crawler, $html);
            $this->info("    Deskripsi: " . Str::limit($desc, 50));
            $this->logMessage("Deskripsi ditemukan: " . Str::limit($desc, 100), 'info');
            
            // Cari kategori ID dari nama dan deskripsi (bisa return null jika tidak ditemukan)
            $categoryId = $this->findCategoryId($name, $desc);
            
            // Cek duplikasi
            if ($this->option('skip-duplicate')) {
                $existingProduct = Product::where('catalog_link', $url)->first();
                if ($existingProduct) {
                    $this->logMessage("Produk sudah ada (ID: {$existingProduct->id}), dilewati", 'warning');
                    return 'skipped';
                }
            }
            
            // Ambil dan proses gambar
            $imagePath = $this->processImage($crawler, $html);
            if ($imagePath) {
                $this->logMessage("Gambar berhasil diproses: $imagePath", 'success');
            } else {
                $this->logMessage("Gambar tidak ditemukan atau gagal diproses", 'warning');
            }
            
            // Simpan ke database (category_id bisa null)
            $product = Product::create([
                'name'          => $name,
                'category_id'   => $categoryId, // Bisa null
                'catalog_link'  => $url,
                'description'   => $desc,
                'image'         => $imagePath,
            ]);
            
            $categoryStatus = $categoryId ? "dengan kategori ID {$categoryId}" : "TANPA kategori (null)";
            $this->logMessage("Produk berhasil disimpan (ID: {$product->id}) - {$categoryStatus}", 'success');
            
            return 'success';
            
        } catch (\Exception $e) {
            $errorMsg = "Error: " . $e->getMessage();
            $this->logMessage($errorMsg, 'error');
            $this->logMessage("Trace: " . $e->getTraceAsString(), 'error');
            return $errorMsg;
        }
    }
    
    /**
     * Ekstrak deskripsi produk (dengan cleaning langsung)
     */
    private function extractDescription(Crawler $crawler, ?string $html = null): string
    {
        if ($html) {
            $fromPayload = $this->extractDescriptionFromHtml($html);
            if ($fromPayload !== '-') {
                return $fromPayload;
            }
        }

        try {
            $rawDesc = $crawler->filter('div.whitespace-pre-line.text-tertiary500')->first()->text();
            $rawDesc = trim($rawDesc);
            
            // Bersihkan TKDN langsung, termasuk nilai rusak seperti [object Object].
            $clean = ProductDescriptionCleaner::clean($rawDesc);
            
            // Perbaiki double text pattern "A - A ..."
            if (preg_match('/^(.+?)\s*-\s*(.+)$/m', $clean, $m)) {
                $judul = trim($m[1]);
                $isi   = trim($m[2]);
                
                // Jika judul sama dengan awal isi (double text)
                if (Str::startsWith($isi, $judul)) {
                    $isi = trim(Str::replaceFirst($judul, '', $isi));
                    $isi = ProductDescriptionCleaner::clean($isi);
                    $clean = $isi;
                }
            }
            
            // Hapus dash di awal jika ada
            $clean = preg_replace('/^\s*[-–]\s*/', '', $clean);
            $clean = trim($clean);
            
            // Jika kosong, set ke "-"
            if ($clean === "" || $clean === "-" || $clean === "–") {
                $clean = "-";
            }
            
            $this->logMessage("Deskripsi berhasil diekstrak (panjang: " . strlen($clean) . " karakter)", 'info');
            
            return $clean;
            
        } catch (\Exception $e) {
            $this->logMessage("Gagal ekstrak deskripsi utama: " . $e->getMessage(), 'warning');
            
            try {
                $desc = $crawler->filter('meta[name="description"]')->attr('content');
                $desc = ProductDescriptionCleaner::clean($desc);
                $result = $desc === "" ? "-" : $desc;
                $this->logMessage("Menggunakan meta description sebagai fallback", 'warning');
                return $result;
            } catch (\Exception $z) {
                $this->logMessage("Gagal mendapatkan meta description", 'error');
                return "-";
            }
        }
    }

    private function extractDescriptionFromHtml(string $html): string
    {
        $rscData = '';

        if (preg_match_all('#self\.__next_f\.push\(\[1,"(.+?)"\]\)#s', $html, $chunks)) {
            foreach ($chunks[1] as $chunk) {
                $rscData .= stripcslashes($chunk);
            }
        }

        if ($rscData === '') {
            return '-';
        }

        preg_match_all('#"description"\s*:\s*"((?:\\\\.|[^"\\\\]){20,})"#s', $rscData, $matches);

        foreach ($matches[1] ?? [] as $candidate) {
            $candidate = ProductDescriptionCleaner::clean(stripcslashes($candidate));

            if (
                $candidate !== ''
                && $candidate !== '-'
                && stripos($candidate, 'Katalog Elektronik') === false
                && stripos($candidate, 'Portal resmi') === false
                && !ProductDescriptionCleaner::looksTruncated($candidate)
            ) {
                return $candidate;
            }
        }

        return '-';
    }
    
    /**
     * Proses gambar dengan remove.bg
     */
    private function processImage(Crawler $crawler, ?string $html = null): ?string
    {
        try {
            $imgSrc = $html ? $this->extractImageUrlFromHtml($html) : null;

            if (!$imgSrc && $crawler->filter('img.object-cover')->count() > 0) {
                $imgSrc = $crawler->filter('img.object-cover')->first()->attr('src');
            }

            if (!$imgSrc) {
                $this->logMessage("Gambar tidak ditemukan di halaman", 'warning');
                return null;
            }

            if ($this->isBadImageCandidate($imgSrc)) {
                $this->logMessage("Kandidat gambar terlihat seperti placeholder/404, dilewati: $imgSrc", 'warning');
                return null;
            }
            
            if (!str_starts_with($imgSrc, 'http')) {
                $imgSrc = 'https://katalog.inaproc.id' . $imgSrc;
            }
            
            $this->logMessage("Mengunduh gambar dari: $imgSrc", 'info');
            $imageResponse = Http::timeout(30)->get($imgSrc);
            if (! $imageResponse->successful() || ! str_contains(strtolower((string) $imageResponse->header('Content-Type')), 'image/')) {
                $this->logMessage("Gagal mengunduh gambar valid. Status: " . $imageResponse->status(), 'warning');
                return null;
            }
            $imageContent = $imageResponse->body();
            
            // Jika tidak ada API key, simpan biasa
            $apiKey = $this->keyManager->getAvailableKey();

            if (!$apiKey) {
                $filename = 'products/robot_' . Str::random(10) . '.jpg';
                Storage::disk('public')->put($filename, $imageContent);
                $this->logMessage("Gambar disimpan tanpa remove.bg: $filename", 'success');
                return $filename;
            }
            
            // Proses dengan remove.bg
            $this->logMessage("Mengirim ke remove.bg API...", 'info');
            $responseRemoveBg = FacadesHttp::timeout(60)
                ->withHeaders(['X-Api-Key' => $apiKey])
                ->attach('image_file', $imageContent, 'image.jpg')
                ->post('https://api.remove.bg/v1.0/removebg');
            
            if ($responseRemoveBg->successful()) {
                $processedImageContent = $responseRemoveBg->body();
                $filename = 'products/robot_no_bg_' . Str::random(10) . '.png';
                Storage::disk('public')->put($filename, $processedImageContent);
                $this->keyManager->recordUsage($apiKey);
                $this->logMessage("Gambar tanpa background berhasil disimpan: $filename", 'success');
                return $filename;
            } else {
                if ($responseRemoveBg->status() === 402) {
                    $this->keyManager->recordUsage($apiKey);
                }
                $this->logMessage("Remove.bg gagal (Status: " . $responseRemoveBg->status() . ")", 'warning');
                $filename = 'products/robot_fallback_' . Str::random(10) . '.jpg';
                Storage::disk('public')->put($filename, $imageContent);
                $this->logMessage("Menyimpan gambar asli: $filename", 'warning');
                return $filename;
            }
            
        } catch (\Exception $e) {
            $this->logMessage("Error gambar: " . $e->getMessage(), 'error');
            return null;
        }
    }

    private function extractImageUrlFromHtml(string $html): ?string
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

    private function isBadImageCandidate(string $url): bool
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
     * Tampilkan summary hasil
     */
    private function showSummary(): void
    {
        $this->info("===========================================");
        $this->info(" SUMMARY HASIL SCRAPING");
        $this->info("===========================================");
        $this->info(" Total diproses   : " . $this->processedCount);
        $this->info(" Berhasil         : " . $this->successCount);
        $this->info(" Dilewati         : " . $this->skippedCount);
        $this->info(" Gagal            : " . $this->failedCount);
        $this->info(" Min match score  : " . $this->minMatchScore);
        
        // Log summary
        $this->logMessage('===========================================', 'info');
        $this->logMessage('SUMMARY HASIL SCRAPING', 'info');
        $this->logMessage('===========================================', 'info');
        $this->logMessage("Total diproses: " . $this->processedCount, 'info');
        $this->logMessage("Berhasil: " . $this->successCount, 'success');
        $this->logMessage("Dilewati: " . $this->skippedCount, 'warning');
        $this->logMessage("Gagal: " . $this->failedCount, 'error');
        $this->logMessage("Min match score: " . $this->minMatchScore, 'info');
        
        if ($this->autoCategoryEnabled) {
            // Hitung statistik kategori
            $totalProducts = Product::count();
            $withCategory = Product::whereNotNull('category_id')->where('category_id', '!=', 0)->count();
            $withoutCategory = $totalProducts - $withCategory;
            $percentage = $totalProducts > 0 ? round(($withCategory / $totalProducts) * 100, 1) : 0;
            
            $this->info("===========================================");
            $this->info(" AUTO CATEGORY STATS");
            $this->info(" Produk dengan kategori : $withCategory/$totalProducts ($percentage%)");
            $this->info(" Produk tanpa kategori  : $withoutCategory ($percentage% dari total)");
            
            // Log category stats
            $this->logMessage('===========================================', 'info');
            $this->logMessage('AUTO CATEGORY STATS', 'info');
            $this->logMessage('===========================================', 'info');
            $this->logMessage("Produk dengan kategori: $withCategory/$totalProducts ($percentage%)", 'info');
            $this->logMessage("Produk tanpa kategori: $withoutCategory", 'info');
            
            // Tampilkan distribusi kategori
            if ($withCategory > 0) {
                $this->info("  Distribusi kategori:");
                $this->logMessage("Distribusi kategori:", 'info');
                
                $topCategories = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('categories.name', DB::raw('COUNT(*) as count'))
                    ->whereNotNull('products.category_id')
                    ->where('products.category_id', '!=', 0)
                    ->groupBy('categories.id', 'categories.name')
                    ->orderBy('count', 'desc')
                    ->limit(5)
                    ->get();
                    
                foreach ($topCategories as $cat) {
                    $catPercentage = round(($cat->count / $withCategory) * 100, 1);
                    $this->info("    - {$cat->name}: {$cat->count} ({$catPercentage}%)");
                    $this->logMessage("{$cat->name}: {$cat->count} ({$catPercentage}%)", 'info');
                }
            }
        }
        
        if ($this->cleanDbEnabled) {
            $this->info("===========================================");
            $this->info(" DATABASE CLEANING");
            $this->info(" [OK] TKDN text dihapus");
            $this->info(" [OK] Double text diperbaiki");
            if ($this->autoCategoryEnabled) {
                $this->info(" [OK] Kategori diupdate dari deskripsi (min score: {$this->minMatchScore})");
            }
            $this->info(" [OK] Whitespace dibersihkan");
            
            $this->logMessage('===========================================', 'info');
            $this->logMessage('DATABASE CLEANING', 'info');
            $this->logMessage('===========================================', 'info');
            $this->logMessage("[OK] TKDN text dihapus", 'success');
            $this->logMessage("[OK] Double text diperbaiki", 'success');
            if ($this->autoCategoryEnabled) {
                $this->logMessage("[OK] Kategori diupdate dari deskripsi (min score: {$this->minMatchScore})", 'success');
            }
            $this->logMessage("[OK] Whitespace dibersihkan", 'success');
        }
        
        $this->info("===========================================");
        $this->logMessage('===========================================', 'info');
        
        if ($this->successCount > 0) {
            $this->info(" Produk berhasil ditambahkan ke database.");
            $this->info(" Cek di: " . url('/products'));
            
            $this->logMessage("Produk berhasil ditambahkan ke database.", 'success');
            $this->logMessage("Cek di: " . url('/products'), 'info');
            
            // Tampilkan contoh produk yang berhasil di-scrape
            $recentProducts = Product::latest()
                ->take(3)
                ->with('category')
                ->get();
                
            if ($recentProducts->isNotEmpty()) {
                $this->info(" Contoh produk terbaru:");
                $this->logMessage("Contoh produk terbaru:", 'info');
                
                foreach ($recentProducts as $product) {
                    $categoryName = $product->category ? $product->category->name : 'NULL (tidak ada)';
                    $this->info("   - {$product->name} → Kategori: {$categoryName}");
                    $this->logMessage("{$product->name} → Kategori: {$categoryName}", 'info');
                }
            }
        }
        
        // Execution time
        $executionTime = round(microtime(true) - LARAVEL_START, 2);
        $this->info(" Waktu eksekusi: {$executionTime} detik");
        $this->logMessage("Waktu eksekusi: {$executionTime} detik", 'info');
    }
    
    /**
     * Log hasil scraping
     */
    private function logResult(): void
    {
        try {
            $categoryStats = [];
            
            if ($this->autoCategoryEnabled) {
                $categoryStats = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('categories.name', DB::raw('COUNT(*) as count'))
                    ->whereNotNull('products.category_id')
                    ->where('products.category_id', '!=', 0)
                    ->groupBy('categories.id', 'categories.name')
                    ->orderBy('count', 'desc')
                    ->get()
                    ->toArray();
            }
            
            Log::channel('scraping')->info('Bulk scraping selesai', [
                'total_processed' => $this->processedCount,
                'success' => $this->successCount,
                'skipped' => $this->skippedCount,
                'failed' => $this->failedCount,
                'auto_category' => $this->autoCategoryEnabled,
                'category_from_description' => $this->categoryFromDescription,
                'min_match_score' => $this->minMatchScore,
                'clean_db' => $this->cleanDbEnabled,
                'category_stats' => $categoryStats,
                'timestamp' => now()->toDateTimeString(),
                'execution_time' => round(microtime(true) - LARAVEL_START, 2)
            ]);
            
            $this->logMessage("Log berhasil disimpan ke scraping channel", 'success');
            
        } catch (\Exception $e) {
            $this->error("Error saving log to channel: " . $e->getMessage());
            $this->logMessage("Error saving log to channel: " . $e->getMessage(), 'error');
            
            // Fallback to default log
            Log::info('Bulk scraping selesai (fallback log)', [
                'processed' => $this->processedCount,
                'success' => $this->successCount,
                'skipped' => $this->skippedCount,
                'failed' => $this->failedCount,
                'timestamp' => now()->toDateTimeString()
            ]);
        }
    }
}
