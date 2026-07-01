<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CatalogBookController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FeedbackClientController;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Public Routes (Rate Limited)
|--------------------------------------------------------------------------
| Dibungkus middleware throttle agar tidak mudah di-flood oleh bot.
| 60 request / menit per IP sudah standar industry.
*/

Route::middleware(['throttle:60,1'])->group(function () {

    // Landing Page
    Route::get('/', [PageController::class, 'home'])->name('home');

    // Halaman Publik
    Route::get('/projects', [PageController::class, 'projects'])->name('projects');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/toocare', [PageController::class, 'toocare'])->name('toocare');
    Route::get('/products', [PageController::class, 'products'])->name('products');
    Route::get('/catalog-book', [PageController::class, 'catalogBook'])->name('catalog-book');
    Route::get('/articles', [PageController::class, 'articles'])->name('articles');
    Route::get('/articles/{article}', [PageController::class, 'articleShow'])->name('articles.show');

    // Brochure PDF inline viewer (agar mobile browser menampilkan, bukan download)
    Route::get('/brochure/view', function (Request $request) {
        $file = basename($request->query('file', ''));
        if (!$file || !preg_match('/\.(pdf)$/i', $file)) abort(404);
        $path = public_path('brochure/' . $file);
        if (!file_exists($path)) abort(404);
        return response()->file($path, ['Content-Disposition' => 'inline; filename="' . $file . '"']);
    })->name('brochure.view');

    // Brochure image serving (handles filenames with spaces/special chars)
    Route::get('/brochure/image', function (Request $request) {
        $file = basename($request->query('path', ''));
        if (!$file || !preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $file)) abort(404);
        $fullPath = public_path('brochure/' . $file);
        if (!file_exists($fullPath)) abort(404);
        return response()->file($fullPath);
    })->name('brochure.image');

    // Feedback (POST) — Anti spam (max 5/min)
    Route::post('/feedback', [FeedbackController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('feedback.store');

    // =============================================
    // SCRAPING ROUTES (Protected by Auth Middleware)
    // =============================================
    
    Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Single URL Scraping (GET - Form)
    Route::get('/scrape', function (Request $request) {
        $targetUrl = $request->query('url');
        
        if (!$targetUrl) {
            return "
                <!DOCTYPE html>
                <html lang='id'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Robot Scraper - Single URL</title>
                    <script src='https://cdn.tailwindcss.com'></script>
                    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
                </head>
                <body class='bg-gray-50'>
                    <div class='min-h-screen flex items-center justify-center p-4'>
                        <div class='bg-white rounded-2xl shadow-xl p-8 max-w-lg w-full'>
                            <div class='text-center mb-8'>
                                <i class='fas fa-robot text-5xl text-blue-500 mb-4'></i>
                                <h1 class='text-3xl font-bold text-gray-800 mb-2'>Robot Scraper</h1>
                                <p class='text-gray-600'>Masukkan URL produk Inaproc untuk di-scrape</p>
                            </div>
                            
                            <form method='GET' class='space-y-6'>
                                <div>
                                    <label class='block text-gray-700 font-medium mb-2'>
                                        <i class='fas fa-link mr-2'></i>URL Produk
                                    </label>
                                    <input 
                                        type='text' 
                                        name='url' 
                                        placeholder='https://katalog.inaproc.id/product/...' 
                                        class='w-full p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500'
                                        required
                                    >
                                    <p class='text-sm text-gray-500 mt-2'>Contoh: https://katalog.inaproc.id/product/12345</p>
                                </div>
                                
                                <div class='flex items-center'>
                                    <input 
                                        type='checkbox' 
                                        id='auto_category' 
                                        name='auto_category' 
                                        value='1'
                                        class='h-5 w-5 text-blue-600 rounded focus:ring-blue-500'
                                        checked
                                    >
                                    <label for='auto_category' class='ml-3 text-gray-700'>
                                        Auto-detect kategori dari nama produk
                                    </label>
                                </div>
                                
                                <div class='pt-4'>
                                    <button 
                                        type='submit' 
                                        class='w-full py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold text-lg rounded-lg transition duration-300 shadow-lg hover:shadow-xl'
                                    >
                                        <i class='fas fa-play mr-2'></i>Mulai Scraping
                                    </button>
                                </div>
                            </form>
                            
                            <div class='mt-8 pt-6 border-t border-gray-200 text-center'>
                                <p class='text-gray-600'>Ingin scrape banyak URL sekaligus?</p>
                                <a href='/scrape-bulk' class='inline-block mt-3 px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium transition'>
                                    <i class='fas fa-layer-group mr-2'></i>Scrape Bulk
                                </a>
                            </div>
                            
                            <div class='mt-6 text-center'>
                                <a href='/products' class='text-blue-500 hover:text-blue-700'>
                                    <i class='fas fa-database mr-1'></i>Cek Database Produk
                                </a>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            ";
        }

        // Validasi URL
        if (!filter_var($targetUrl, FILTER_VALIDATE_URL)) {
            return "
                <div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>
                    <h2 style='color: red;'>URL Tidak Valid</h2>
                    <p><code>" . e($targetUrl) . "</code></p>
                    <a href='/scrape' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background: blue; color: white; text-decoration: none; border-radius: 5px;'>
                        Coba lagi
                    </a>
                </div>
            ";
        }

        try {
            // Jalankan scraping dengan optional auto-category
            $autoCategory = $request->has('auto_category');
            
            Artisan::call('scrape:product', [
                'url' => $targetUrl,
                '--auto-category' => $autoCategory
            ]);
            
            $output = Artisan::output();
            
            return "
                <!DOCTYPE html>
                <html lang='id'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Hasil Scraping - Single URL</title>
                    <script src='https://cdn.tailwindcss.com'></script>
                    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
                    <style>
                        pre {
                            white-space: pre-wrap;
                            word-wrap: break-word;
                            max-height: 500px;
                            overflow-y: auto;
                        }
                    </style>
                </head>
                <body class='bg-gray-50'>
                    <div class='min-h-screen p-4 md:p-8'>
                        <div class='max-w-4xl mx-auto'>
                            <div class='text-center mb-10'>
                                <h1 class='text-3xl font-bold text-gray-800 mb-3'>
                                    <i class='fas fa-robot mr-3 text-blue-500'></i>Laporan Scraping
                                </h1>
                                <p class='text-gray-600'>Single Produk - " . ($autoCategory ? 'Auto Category Enabled' : '') . "</p>
                            </div>
                            
                            <div class='bg-white rounded-xl shadow-lg p-6 mb-6'>
                                <h2 class='text-xl font-semibold text-gray-700 mb-4'>
                                    <i class='fas fa-info-circle mr-2 text-blue-500'></i>Informasi
                                </h2>
                                <div class='space-y-2 mb-6'>
                                    <p><strong>Target URL:</strong> <a href='" . e($targetUrl) . "' target='_blank' class='text-blue-500 hover:text-blue-700 break-all'>" . e($targetUrl) . "</a></p>
                                    <p><strong>Auto Category:</strong> " . ($autoCategory ? 'Aktif' : 'Nonaktif') . "</p>
                                    <p><strong>Waktu:</strong> " . now()->format('d/m/Y H:i:s') . "</p>
                                </div>
                                
                                <h2 class='text-xl font-semibold text-gray-700 mb-4'>
                                    <i class='fas fa-terminal mr-2 text-green-500'></i>Output Console
                                </h2>
                                <pre class='bg-gray-900 text-green-400 p-4 rounded-lg'>" . e($output) . "</pre>
                            </div>
                            
                            <div class='flex flex-wrap gap-4 justify-center'>
                                <a href='/products' class='px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium transition'>
                                    <i class='fas fa-database mr-2'></i>Lihat Database
                                </a>
                                <a href='/scrape' class='px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium transition'>
                                    <i class='fas fa-redo mr-2'></i>Scrape Lagi
                                </a>
                                <a href='/scrape-bulk' class='px-6 py-3 bg-purple-500 hover:bg-purple-600 text-white rounded-lg font-medium transition'>
                                    <i class='fas fa-layer-group mr-2'></i>Scrape Bulk
                                </a>
                                <a href='/' class='px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition'>
                                    <i class='fas fa-home mr-2'></i>Home
                                </a>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            ";
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Scrape error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return "
                <div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>
                    <h2 style='color: red;'>Error System</h2>
                    <p style='color: #666; margin: 20px 0;'>Terjadi kesalahan saat scraping. Silakan coba lagi.</p>
                    <a href='/scrape' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background: blue; color: white; text-decoration: none; border-radius: 5px;'>
                        Kembali ke Form
                    </a>
                </div>
            ";
        }
    })->name('scrape.single');

    // 2. Bulk URL Scraping (GET - Form)
    Route::get('/scrape-bulk', function () {
        return view('scrape-bulk');
    })->name('scrape.bulk.form');

    // 3. Bulk URL Scraping (POST - Processing)
    Route::post('/scrape-bulk', function (Request $request) {
        $request->validate([
            'urls' => 'required|string',
            'delay' => 'integer|min:0|max:10',
            'skip_duplicate' => 'boolean',
            'auto_category' => 'boolean',
            'max' => 'integer|min:0|max:500',
        ]);

        // Parse URLs
        $urls = array_filter(
            explode("\n", $request->urls),
            fn($url) => !empty(trim($url))
        );

        if (empty($urls)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada URL yang valid'
            ], 422);
        }

        // Validasi setiap URL
        $validUrls = [];
        $invalidUrls = [];
        
        foreach ($urls as $url) {
            $url = trim($url);
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $validUrls[] = $url;
            } else {
                $invalidUrls[] = $url;
            }
        }

        if (empty($validUrls)) {
            return response()->json([
                'success' => false,
                'message' => 'Semua URL tidak valid'
            ], 422);
        }

        // Simpan ke file temporary
        $filename = 'scrape_urls_' . time() . '_' . Str::random(8) . '.txt';
        $filePath = storage_path('app/temp/' . $filename);
        
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }
        
        file_put_contents($filePath, implode("\n", $validUrls));

        // Persiapkan parameter command
        $command = 'scrape:bulk';
        $params = [
            '--file' => $filePath,
            '--delay' => $request->delay ?? 2,
        ];

        if ($request->skip_duplicate) {
            $params['--skip-duplicate'] = true;
        }

        if ($request->auto_category) {
            $params['--auto-category'] = true;
        }

        if ($request->max && $request->max > 0) {
            $params['--max'] = $request->max;
        }

        try {
            // Jalankan command
            Artisan::call($command, $params);
            $output = Artisan::output();

            // Parse hasil dari output
            $stats = [
                'total_processed' => 0,
                'success' => 0,
                'skipped' => 0,
                'failed' => 0,
                'with_category' => 0,
                'without_category' => 0
            ];

            // Extract stats dari output
            if (preg_match('/Total diproses\s*:\s*(\d+)/', $output, $matches)) {
                $stats['total_processed'] = (int)$matches[1];
            }
            if (preg_match('/Berhasil\s*:\s*(\d+)/', $output, $matches)) {
                $stats['success'] = (int)$matches[1];
            }
            if (preg_match('/Dilewati\s*:\s*(\d+)/', $output, $matches)) {
                $stats['skipped'] = (int)$matches[1];
            }
            if (preg_match('/Gagal\s*:\s*(\d+)/', $output, $matches)) {
                $stats['failed'] = (int)$matches[1];
            }
            if (preg_match('/Produk dengan kategori\s*:\s*(\d+)\/(\d+)/', $output, $matches)) {
                $stats['with_category'] = (int)$matches[1];
                $stats['without_category'] = (int)$matches[2] - (int)$matches[1];
            }

            // Hapus file temporary
            unlink($filePath);

            return response()->json([
                'success' => true,
                'output' => $output,
                'stats' => $stats,
                'total_urls' => count($validUrls),
                'invalid_urls' => $invalidUrls,
                'valid_urls' => count($validUrls),
                'timestamp' => now()->toDateTimeString(),
            ]);

        } catch (\Exception $e) {
            // Hapus file temporary jika ada error
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    })->middleware('throttle:10,1')->name('scrape.bulk.process');

    // 4. Batch Process Results (GET - Untuk melihat hasil proses batch)
    Route::get('/scrape-results/{batchId?}', function ($batchId = null) {
        // Ini bisa dikembangkan untuk melihat hasil batch tertentu
        // Untuk sekarang tampilkan semua produk terbaru
        
        $products = \App\Models\Product::latest()
            ->take(20)
            ->with('category')
            ->get();
        
        return view('scrape-results', [
            'products' => $products,
            'batchId' => $batchId
        ]);
    })->name('scrape.results');

    }); // End Scraping Auth Group

});

/*
|--------------------------------------------------------------------------
| Dashboard (Protected)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| User Profile (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Admin Panel (Protected + Prefix + Rate Limited)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'throttle:30,1'])
    ->prefix('admin')
    ->group(function () {

        // Feedback dari pengunjung
        Route::get('/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.index');
        Route::post('/feedback/{id}/read', [FeedbackController::class, 'markAsRead'])->name('admin.feedback.read');
        Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');

        // Products
        Route::get('/products/bulk-edit', [ProductController::class, 'bulkEdit'])->name('products.bulk-edit');
        Route::post('/products/bulk-update-category', [ProductController::class, 'bulkUpdateCategory'])->name('products.bulk-update-category');
        Route::get('/products/scrape-live', [ProductController::class, 'scrapeLog'])->name('products.scrape.log');
        Route::get('/products/scrape-live/stream', [ProductController::class, 'scrapeStream'])->name('products.scrape.stream');
        Route::get('/products/command-log/{token}', [ProductController::class, 'commandLogRead'])->name('products.command-log.read');
        Route::get('/products/repair-images/live', [ProductController::class, 'repairImagesLog'])->name('products.repair-images.log');
        Route::get('/products/repair-images/live/stream', [ProductController::class, 'repairImagesStream'])->name('products.repair-images.stream');
        Route::get('/products/dead-links/live', [ProductController::class, 'deactivateDeadLinksLog'])->name('products.deactivate-dead-links.log');
        Route::get('/products/dead-links/live/stream', [ProductController::class, 'deactivateDeadLinksStream'])->name('products.deactivate-dead-links.stream');
        Route::get('/products/{product}/sync-inaproc/live', [ProductController::class, 'syncInaprocLog'])->name('products.sync-inaproc.log');
        Route::get('/products/{product}/sync-inaproc/live/stream', [ProductController::class, 'syncInaprocStream'])->name('products.sync-inaproc.stream');
        Route::post('/products/repair-images', [ProductController::class, 'repairImages'])->name('products.repair-images');
        Route::post('/products/deactivate-dead-links', [ProductController::class, 'deactivateDeadLinks'])->name('products.deactivate-dead-links');
        Route::post('/products/{product}/toggle-active', [ProductController::class, 'toggleActive'])->name('products.toggle-active');
        Route::post('/products/{product}/sync-inaproc', [ProductController::class, 'syncInaproc'])->name('products.sync-inaproc');
        Route::resource('/products', ProductController::class)->except(['show']);
        Route::post('/products/{product}/remove-background', [ProductController::class, 'removeBackground'])->name('products.remove-background');

        // Articles
        Route::resource('/articles', ArticleController::class)->except(['show']);

        // Catalog Books
        Route::resource('/catalog-books', CatalogBookController::class)
            ->parameters(['catalog-books' => 'catalogBook'])
            ->except(['show']);

        // Categories
        Route::resource('/categories', CategoryController::class)->except(['show']);

        // Feedback Client
        Route::resource('/feedbackclient', FeedbackClientController::class)->except(['show']);

        // Scraping Management (Admin Only)
        Route::get('/scraping-logs', function () {
            $logs = \App\Models\Product::with('category')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            
            return view('admin.scraping-logs', compact('logs'));
        })->name('admin.scraping.logs');

        Route::get('/scraping-stats', function () {
            $stats = [
                'total_products' => \App\Models\Product::count(),
                'with_category' => \App\Models\Product::whereNotNull('category_id')->count(),
                'without_category' => \App\Models\Product::whereNull('category_id')->count(),
                'today_count' => \App\Models\Product::whereDate('created_at', today())->count(),
                'categories_count' => \App\Models\Category::count(),
                'top_categories' => \App\Models\Category::withCount('products')
                    ->orderBy('products_count', 'desc')
                    ->take(10)
                    ->get()
            ];
            
            return view('admin.scraping-stats', compact('stats'));
        })->name('admin.scraping.stats');
    });


/*
|--------------------------------------------------------------------------
| Storage File Access (Fix Symlink CPanel)
|--------------------------------------------------------------------------
*/

$servePublicStorageFile = function ($path) {
    $path = str_replace('\\', '/', ltrim($path, '/'));

    if ($path === '' || Str::contains($path, ['..', "\0"])) {
        abort(404);
    }

    $basePath = realpath(storage_path('app/public'));
    $filePath = realpath(storage_path('app/public/' . $path));

    if (!$filePath) {
        $publicStorageBase = realpath(public_path('storage'));
        $publicStorageFile = realpath(public_path('storage/' . $path));

        if ($publicStorageBase && $publicStorageFile && str_starts_with($publicStorageFile, $publicStorageBase . DIRECTORY_SEPARATOR) && is_file($publicStorageFile)) {
            return response()->file($publicStorageFile, [
                'Cache-Control' => 'public, max-age=604800',
            ]);
        }
    }

    if (!$basePath || !$filePath || !str_starts_with($filePath, $basePath . DIRECTORY_SEPARATOR) || !is_file($filePath)) {
        abort(404);
    }

    return response()->file($filePath, [
        'Cache-Control' => 'public, max-age=604800',
    ]);
};

Route::get('/storage/app/public/{path}', $servePublicStorageFile)
    ->where('path', '.*')
    ->name('storage.app.public');

Route::get('/media/{path}', $servePublicStorageFile)
    ->where('path', '.*')
    ->name('media.storage');

Route::get('/storage/{folder}/{filename}', function($folder, $filename) {
    $path = storage_path("app/public/{$folder}/{$filename}");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});


/*
|--------------------------------------------------------------------------
| Debug Routes (Hanya untuk development)
|--------------------------------------------------------------------------
*/

if (app()->environment('local')) {
    Route::get('/debug/scrape-test', function () {
        // Test route untuk debugging
        return response()->json([
            'categories' => \App\Models\Category::all()->pluck('name', 'id'),
            'mapping' => [
                'dentsply' => 71,
                'too care' => 47,
                'remedi' => 48,
                'omron' => 52,
                'sinocare' => 51,
            ]
        ]);
    });
}

require __DIR__.'/auth.php';
