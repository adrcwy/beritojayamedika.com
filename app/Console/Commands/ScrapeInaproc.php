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

class ScrapeInaproc extends Command
{
    protected $signature = 'scrape:product 
                            {url} 
                            {--auto-category : Otomatis isi kategori berdasarkan nama produk}
                            {--clean-existing : Bersihkan deskripsi produk yang sudah ada}';

    protected $description = 'Scrape produk Inaproc (Fix Deskripsi & Double Text)';

    private $categoryMap = [];

    public function handle()
    {
        $url = $this->argument('url');
        $this->info("Sedang memproses: $url");

        // Load kategori jika auto-category diaktifkan
        if ($this->option('auto-category')) {
            $this->loadCategoryMap();
            $this->info("Auto-category enabled. Loaded " . count($this->categoryMap) . " kategori");
        }

        // Bersihkan produk yang sudah ada jika diaktifkan
        if ($this->option('clean-existing')) {
            $this->cleanExistingProducts();
        }

            $headers = [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.5',
                'Accept-Encoding' => 'gzip, deflate',
                'Connection' => 'keep-alive',
                'Upgrade-Insecure-Requests' => '1',
            ];
            
            $response = Http::withHeaders($headers)->get($url);

        $html = $response->body();
        $crawler = new Crawler($html);

        try {
            // A. AMBIL NAMA
            try {
                $name = trim($crawler->filter('h1')->first()->text());
            } catch (\Exception $e) {
                $this->error("Gagal menemukan nama produk.");
                return;
            }

            // Cek Duplikasi
            $existingProduct = Product::where('catalog_link', $url)->first();
            if ($existingProduct) {
                $this->warn("Produk sudah ada! ID: {$existingProduct->id}");
                $description = $this->extractDescription($crawler, $html);
                $imagePath = $this->processImage($crawler, $html);

                // Update jika ada perubahan
                $updates = [
                    'name' => $name,
                    'category_id' => $this->option('auto-category') ? $this->findCategoryId($name) : $existingProduct->category_id,
                    'description' => $description,
                    'is_active' => true,
                    'updated_at' => now()
                ];

                if ($imagePath) {
                    $updates['image'] = $imagePath;
                }

                $existingProduct->update($updates);

                $this->info("Produk berhasil diupdate!");
                if ($imagePath) {
                    $this->info("Gambar diperbarui: $imagePath");
                }
                return;
            }

            // Cari kategori ID jika auto-category aktif
            $categoryId = null;
            if ($this->option('auto-category')) {
                $categoryId = $this->findCategoryId($name);
            }

            // B. AMBIL DESKRIPSI
            $desc = $this->extractDescription($crawler, $html);

            // C. AMBIL GAMBAR & HAPUS BACKGROUND
            $imagePath = $this->processImage($crawler, $html);

            // D. SIMPAN
            Product::create([
                'name'          => $name,
                'category_id'   => $categoryId,
                'catalog_link'  => $url,
                'description'   => empty($desc) ? '-' : $desc,
                'image'         => $imagePath,
            ]);

            $this->info("SUKSES! Produk '$name' berhasil disimpan.");
            $this->info("Kategori: " . ($categoryId ? "ID $categoryId" : "Tidak ditemukan"));
            $this->info("Deskripsi Final: " . Str::limit($desc, 100));
            if ($imagePath) {
                $this->info("Gambar disimpan di: $imagePath");
            } else {
                $this->info("Gambar tidak ditemukan atau gagal diproses.");
            }

        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }

    /**
     * Bersihkan produk yang sudah ada
     */
    private function cleanExistingProducts(): void
    {
        $this->info("Membersihkan produk yang sudah ada...");

        // Langkah 1: Hapus teks TKDN
        $tkdnPattern = 'TKDN: 0%. Tersedia di Katalog Elektronik Pemerintah.';

        $affected = DB::table('products')
            ->where('description', 'LIKE', '%' . $tkdnPattern . '%')
            ->update([
                'description' => DB::raw("TRIM(REPLACE(description, '$tkdnPattern', ''))"),
                'updated_at' => now()
            ]);

        $this->info("[OK] $affected produk diperbarui (hapus TKDN)");

        // Langkah 2: Perbaiki pola double text
        $affected = DB::table('products')
            ->whereRaw("description LIKE '% - %'")
            ->whereRaw("SUBSTRING_INDEX(description, ' - ', 1) = SUBSTRING_INDEX(SUBSTRING_INDEX(description, ' - ', 2), ' - ', -1)")
            ->update([
                'description' => DB::raw("TRIM(SUBSTRING(description, LENGTH(SUBSTRING_INDEX(description, ' - ', 1)) + 4))"),
                'updated_at' => now()
            ]);

        $this->info("[OK] $affected produk diperbarui (perbaiki double text)");
    }

    /**
     * Load kategori dari database untuk mapping
     */
    private function loadCategoryMap(): void
    {
        $categories = Category::all(['id', 'name', 'slug']);

        foreach ($categories as $category) {
            $this->categoryMap[strtolower($category->name)] = $category->id;
            $this->categoryMap[strtolower($category->slug)] = $category->id;
        }
    }

    /**
     * Cari kategori berdasarkan nama produk
     */
    private function findCategoryId(string $productName): ?int
    {
        if (empty($this->categoryMap)) {
            return null;
        }

        $productNameLower = strtolower(trim($productName));

        // Keyword mapping berdasarkan ID
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
        ];

        // Cek keyword mapping terlebih dahulu
        foreach ($keywordMapping as $keyword => $categoryId) {
            if (stripos($productNameLower, $keyword) !== false) {
                $this->info("Kategori ditemukan via keyword: $keyword (ID: $categoryId)");
                return $categoryId;
            }
        }

        // Cek di category map
        foreach ($this->categoryMap as $categoryKey => $categoryId) {
            if (stripos($productNameLower, $categoryKey) !== false) {
                $this->info("Kategori ditemukan: $categoryKey (ID: $categoryId)");
                return $categoryId;
            }
        }

        return null;
    }

    /**
     * Ekstrak deskripsi produk
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

            $clean = ProductDescriptionCleaner::clean($rawDesc);

            if (preg_match('/^(.+?)\s*-\s*(.+)$/m', $clean, $m)) {
                $judul = trim($m[1]);
                $isi   = trim($m[2]);
                if (Str::startsWith($isi, $judul)) {
                    $isi = trim(Str::replaceFirst($judul, '', $isi));
                    $isi = ProductDescriptionCleaner::clean($isi);
                    $clean = $isi;
                }
            }

            $clean = preg_replace('/^\s*[-–]\s*/', '', $clean);
            $clean = trim($clean);

            if ($clean === "" || $clean === "-" || $clean === "–") {
                $clean = "-";
            }

            return $clean;

        } catch (\Exception $e) {
            try {
                $desc = $crawler->filter('meta[name="description"]')->attr('content');
                $desc = ProductDescriptionCleaner::clean($desc);
                return $desc === "" ? "-" : $desc;
            } catch (\Exception $z) {
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
     * Proses gambar - Ambil dari web dan hapus background menggunakan API remove.bg jika API key tersedia
     */
    private function processImage(Crawler $crawler, ?string $html = null): ?string
    {
        $keyManager = new \App\Services\RemoveBgKeyManager();
        $apiKey = $keyManager->getAvailableKey();

        try {
            $imgSrc = $html ? $this->extractImageUrlFromHtml($html) : null;

            if (!$imgSrc && $crawler->filter('img.object-cover')->count() > 0) {
                $imgSrc = $crawler->filter('img.object-cover')->first()->attr('src');
            }

            if (!$imgSrc) {
                 $this->error("URL gambar tidak ditemukan di payload maupun elemen gambar.");
                 return null; // Gagal ambil URL gambar
            }

            if ($this->isBadImageCandidate($imgSrc)) {
                $this->warn("Kandidat gambar terlihat seperti placeholder/404, dilewati: $imgSrc");
                return null;
            }

            // Pastikan URL lengkap
            if (!str_starts_with($imgSrc, 'http')) {
                // Perbaikan: Hapus spasi ekstra dari baseUrl
                $baseUrl = 'https://katalog.inaproc.id'; // Tanpa spasi
                $imgSrc = rtrim($baseUrl, '/') . '/' . ltrim($imgSrc, '/');
            }

            $this->info("Mengambil gambar dari: $imgSrc");

            // Ambil konten gambar asli
            $imageResponse = Http::get($imgSrc);
            if (!$imageResponse->successful()) {
                $this->error("Gagal mengambil gambar dari URL: $imgSrc. Status: " . $imageResponse->status());
                return null; // Gagal ambil konten gambar
            }
            $imageContent = $imageResponse->body();

            // Ekstrak ekstensi file dari URL atau default ke jpg
            $parsedUrlPath = parse_url($imgSrc, PHP_URL_PATH);
            $extension = pathinfo($parsedUrlPath, PATHINFO_EXTENSION);
            if (empty($extension)) {
                $extension = 'jpg'; // Default jika tidak ditemukan ekstensi
            }

            // Simpan gambar asli sebagai fallback sementara
            $fallbackFilename = 'products/robot_fallback_' . Str::random(10) . '.' . $extension;
            Storage::disk('public')->put($fallbackFilename, $imageContent);
            $this->info("Gambar fallback disimpan: $fallbackFilename");

            // Jika API key tidak diset, langsung gunakan fallback
            if (!$apiKey) {
                $this->warn("API Key Remove.bg tidak ditemukan di .env. Menggunakan gambar asli sebagai fallback.");
                return $fallbackFilename; // Kembalikan file fallback yang sudah disimpan
            }

            $this->info("API Key Remove.bg ditemukan. Mengirim ke API...");
            // Kirim ke API remove.bg
            $responseRemoveBg = Http::withHeaders(['X-Api-Key' => $apiKey])
                ->timeout(60) // Tambahkan timeout yang lebih panjang, misalnya 60 detik
                ->attach('image_file', $imageContent, 'original_image.' . $extension) // Kirim dengan ekstensi asli
                ->post('https://api.remove.bg/v1.0/removebg'); // Perbaikan: Hapus spasi di akhir URL

            if ($responseRemoveBg->successful()) {
                // Periksa header Content-Type apakah benar-benar gambar
                $contentType = $responseRemoveBg->header('Content-Type');
                if (strpos($contentType, 'image/') === 0) {
                    // Jika sukses dan merupakan gambar, simpan hasilnya (tanpa background)
                    $processedImageContent = $responseRemoveBg->body();
                    // Gunakan .png untuk hasil dari remove.bg
                    $finalFilename = 'products/robot_no_bg_' . Str::random(10) . '.png';
                    Storage::disk('public')->put($finalFilename, $processedImageContent);

                    // Hapus file fallback karena kita punya file final
                    Storage::disk('public')->delete($fallbackFilename);
                    $keyManager->recordUsage($apiKey);

                    $this->info("Gambar berhasil diproses dan disimpan tanpa latar belakang: $finalFilename");
                    return $finalFilename;
                } else {
                    // Respon sukses tapi bukan gambar (mungkin JSON error message)
                    $this->warn("API Remove.bg merespons sukses, tetapi bukan gambar. Menggunakan fallback. Respon: " . $responseRemoveBg->body());
                    return $fallbackFilename;
                }
            } else {
                // Jika API gagal (misalnya status bukan 200)
                $statusCode = $responseRemoveBg->status();
                $errorMessage = $responseRemoveBg->body(); // Ambil body respon error untuk info tambahan
                if ($statusCode === 402) {
                    $keyManager->recordUsage($apiKey);
                }
                $this->warn("API Remove.bg gagal. Status: $statusCode. Pesan: $errorMessage. Menggunakan gambar asli sebagai fallback.");
                // $fallbackFilename sudah disimpan sebelumnya, jadi kembalikan itu.
                return $fallbackFilename;
            }

        } catch (\Exception $e) {
            $this->error("Error saat memproses gambar: " . $e->getMessage());
            // Jika error terjadi di dalam blok try utama, dan file fallback *telah* dibuat sebelum error terjadi,
            // kita bisa mencoba mengembalikannya. Karena kita menyimpan fallback segera setelah mendapatkan $imageContent,
            // variabel $fallbackFilename seharusnya sudah didefinisikan dan file disimpan sebelum pemanggilan API.
            // Namun, untuk keamanan, kita bisa mengecek eksistensinya.
            // Jika error terjadi sebelum file dibuat (misalnya, gagal mendapatkan $imgSrc atau $imageContent),
            // maka $fallbackFilename tidak akan ada, dan kita kembalikan null.
            // Kita asumsikan bahwa error umum (seperti gagal download gambar) sudah ditangani sebelumnya.
            // Jadi error di sini kemungkinan besar adalah masalah lain (misalnya storage penuh saat menyimpan fallback).
            // Dalam kasus ekstrem itu, kita tetap return null.
            // Jika error terjadi *setelah* file fallback disimpan (misalnya error dari API sendiri yang aneh),
            // kita bisa cek apakah file ada.
            // Untuk kasus seperti error 402 API, file fallback *sudah* dibuat dan disimpan sebelum pemanggilan API,
            // jadi blok catch ini sebenarnya tidak akan terpicu untuk error 402 API itu sendiri, karena pemanggilan API
            // ada di dalam blok `if`.
            // Error 402 ditangani oleh `if (!$responseRemoveBg->successful())`.
            // Catch ini hanya untuk exception PHP atau network issues sebelum API dipanggil atau saat handling response.
            // Kita tetap sisipkan logika fallback disini sebagai jalan keluar darurat.
            $lastFallbackCreated = $fallbackFilename ?? null; // Ambil nama file fallback terakhir yang seharusnya dibuat
            if ($lastFallbackCreated && Storage::disk('public')->exists($lastFallbackCreated)) {
                $this->info("Menggunakan file fallback terakhir yang disimpan karena error: $lastFallbackCreated");
                return $lastFallbackCreated;
            }
            return null; // Jika file fallback tidak ada atau gagal disimpan sebelumnya
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
}
