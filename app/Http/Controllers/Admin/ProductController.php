<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Support\MediaPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\StreamOutput;

class ProductController extends Controller
{

public function index(Request $request)
{
    // 1. Query Dasar
    $query = Product::with('category')->latest();

    // 2. Logika Pencarian
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhereHas('category', function($subQ) use ($search) {
                  $subQ->where('name', 'LIKE', "%{$search}%");
              });
        });
    }

    // 3. Pagination & Query String (agar search tidak hilang saat pindah page)
    $products = $query->paginate(10)->withQueryString();
    $categories = Category::orderBy('name')->get();
    $activeCount = Product::where('is_active', true)->count();
    $inactiveCount = Product::where('is_active', false)->count();

    return view('admin.products.index', compact('products', 'categories', 'activeCount', 'inactiveCount'));
}
    
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string|max:65535',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'catalog_link' => 'nullable|url|max:500',
            'is_active' => 'nullable|boolean',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
            'category_id' => $request->category_id,
            'catalog_link' => $request->catalog_link,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string|max:65535',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'catalog_link' => 'nullable|url|max:500',
            'is_active' => 'nullable|boolean',
        ]);

        $path = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
            'category_id' => $request->category_id,
            'catalog_link' => $request->catalog_link,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function bulkEdit(Request $request)
    {
        $query = Product::with('category')->orderBy('name');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $products = $query->paginate(50)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.bulk-edit', compact('products', 'categories'));
    }

    public function bulkUpdateCategory(Request $request)
    {
        $data = $request->validate([
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'integer|exists:products,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::whereIn('id', $data['product_ids'])->update([
            'category_id' => $data['category_id'],
            'updated_at' => now(),
        ]);

        return back()->with('success', count($data['product_ids']) . ' produk berhasil dipasang ke kategori terpilih.');
    }

    public function toggleActive(Product $product)
    {
        $product->forceFill(['is_active' => ! $product->is_active])->save();

        return back()->with('success', 'Status produk berhasil diubah.');
    }

    public function syncInaproc(Product $product)
    {
        if (! $product->catalog_link) {
            return back()->with('error', 'Produk ini belum punya link INAPROC.');
        }

        Artisan::call('scrape:product', [
            'url' => $product->catalog_link,
            '--auto-category' => true,
        ]);

        return back()->with('success', 'Sync INAPROC selesai. Output: ' . \Illuminate\Support\Str::limit(trim(Artisan::output()), 800));
    }

    public function scrapeLog(Request $request)
    {
        if (! $request->filled('url')) {
            return view('admin.products.scrape-live');
        }

        $request->validate([
            'url' => 'required|url|max:1000',
        ]);

        $targetUrl = $request->input('url');

        return view('admin.products.command-log', [
            'title' => 'Scrape Manual INAPROC',
            'subtitle' => $targetUrl,
            'startUrl' => route('products.scrape.stream', [
                'url' => $targetUrl,
                'auto_category' => $request->boolean('auto_category', true) ? 1 : 0,
            ]),
            'readUrlTemplate' => route('products.command-log.read', ['token' => '__TOKEN__']),
            'backUrl' => route('products.index'),
        ]);
    }

    public function scrapeStream(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:1000',
        ]);

        return $this->startBackgroundArtisanCommand('scrape:product', [
            'url' => $request->input('url'),
            '--auto-category' => $request->boolean('auto_category', true),
        ]);
    }

    public function syncInaprocLog(Product $product)
    {
        if (! $product->catalog_link) {
            return redirect()->route('products.index')->with('error', 'Produk ini belum punya link INAPROC.');
        }

        return view('admin.products.command-log', [
            'title' => 'Sync INAPROC Produk',
            'subtitle' => $product->name,
            'startUrl' => route('products.sync-inaproc.stream', $product),
            'readUrlTemplate' => route('products.command-log.read', ['token' => '__TOKEN__']),
            'backUrl' => route('products.index'),
        ]);
    }

    public function syncInaprocStream(Product $product)
    {
        if (! $product->catalog_link) {
            return $this->startTextLog("Produk ini belum punya link INAPROC.\n");
        }

        return $this->startBackgroundArtisanCommand('scrape:product', [
            'url' => $product->catalog_link,
            '--auto-category' => true,
        ]);
    }

    public function repairImagesLog()
    {
        return view('admin.products.command-log', [
            'title' => 'Repair Gambar Produk',
            'subtitle' => 'Menampilkan progress download ulang gambar INAPROC.',
            'startUrl' => route('products.repair-images.stream'),
            'readUrlTemplate' => route('products.command-log.read', ['token' => '__TOKEN__']),
            'backUrl' => route('products.index'),
        ]);
    }

    public function repairImagesStream()
    {
        return $this->startBackgroundArtisanCommand('products:repair-images', [
            '--delay' => 500,
        ]);
    }

    public function deactivateDeadLinksLog()
    {
        return view('admin.products.command-log', [
            'title' => 'Cek Link Mati INAPROC',
            'subtitle' => 'Produk akan dibuat inactive kalau link jelas 404/tidak ditemukan.',
            'startUrl' => route('products.deactivate-dead-links.stream'),
            'readUrlTemplate' => route('products.command-log.read', ['token' => '__TOKEN__']),
            'backUrl' => route('products.index'),
        ]);
    }

    public function deactivateDeadLinksStream()
    {
        return $this->startBackgroundArtisanCommand('products:deactivate-dead-links');
    }

    public function repairImages()
    {
        Artisan::call('products:repair-images', [
            '--delay' => 1,
        ]);

        return back()->with('success', 'Repair gambar selesai. Output: ' . \Illuminate\Support\Str::limit(trim(Artisan::output()), 800));
    }

    public function deactivateDeadLinks()
    {
        Artisan::call('products:deactivate-dead-links');

        return back()->with('success', 'Pengecekan link mati selesai. Output: ' . \Illuminate\Support\Str::limit(trim(Artisan::output()), 800));
    }

    public function commandLogRead(string $token)
    {
        abort_unless(preg_match('/^[a-zA-Z0-9\\-]+$/', $token), 404);

        $path = storage_path('app/command-logs/' . $token . '.log');
        abort_unless(is_file($path), 404);

        $text = file_get_contents($path) ?: '';

        return response()->json([
            'text' => $text,
            'done' => str_contains($text, '---COMMAND_FINISHED:'),
        ]);
    }

    private function startBackgroundArtisanCommand(string $command, array $parameters = [])
    {
        $token = (string) \Illuminate\Support\Str::uuid();
        $logPath = $this->commandLogPath($token);
        $this->ensureCommandLogDirectory();

        file_put_contents($logPath,
            'Menjalankan: php artisan ' . $command . PHP_EOL .
            'Waktu mulai: ' . now()->format('d/m/Y H:i:s') . PHP_EOL .
            str_repeat('-', 72) . PHP_EOL
        );

        $shellCommand = $this->buildBackgroundArtisanCommand($command, $parameters, $logPath);
        if (! function_exists('exec')) {
            file_put_contents($logPath, PHP_EOL . '[ERROR] PHP exec() dinonaktifkan di hosting, jadi command tidak bisa dijalankan dari admin.' . PHP_EOL . '---COMMAND_FINISHED:1---' . PHP_EOL, FILE_APPEND);
        } else {
            @exec($shellCommand);
        }

        return response()->json([
            'token' => $token,
            'readUrl' => route('products.command-log.read', ['token' => $token]),
        ]);
    }

    private function startTextLog(string $text)
    {
        $token = (string) \Illuminate\Support\Str::uuid();
        $logPath = $this->commandLogPath($token);
        $this->ensureCommandLogDirectory();

        file_put_contents($logPath, $text . PHP_EOL . "---COMMAND_FINISHED:0---" . PHP_EOL);

        return response()->json([
            'token' => $token,
            'readUrl' => route('products.command-log.read', ['token' => $token]),
        ]);
    }

    private function buildBackgroundArtisanCommand(string $command, array $parameters, string $logPath): string
    {
        $php = env('PHP_CLI_BINARY', 'php');
        $artisan = base_path('artisan');
        $arguments = $this->buildArtisanArguments($command, $parameters);
        $root = base_path();

        if (PHP_OS_FAMILY === 'Windows') {
            $cmd = 'cd /d ' . escapeshellarg($root) . ' && ' . escapeshellcmd($php) . ' ' . escapeshellarg($artisan) . ' ' . $arguments . ' >> ' . escapeshellarg($logPath) . ' 2>&1 && echo ---COMMAND_FINISHED:%ERRORLEVEL%--- >> ' . escapeshellarg($logPath);

            return 'start /B cmd /C ' . escapeshellarg($cmd);
        }

        return '( cd ' . escapeshellarg($root)
            . ' && ' . escapeshellcmd($php) . ' ' . escapeshellarg($artisan) . ' ' . $arguments
            . ' >> ' . escapeshellarg($logPath) . ' 2>&1; code=$?; printf "\\n---COMMAND_FINISHED:%s---\\n" "$code" >> '
            . escapeshellarg($logPath) . ' ) > /dev/null 2>&1 &';
    }

    private function buildArtisanArguments(string $command, array $parameters): string
    {
        $parts = [escapeshellarg($command)];

        foreach ($parameters as $key => $value) {
            if (is_int($key)) {
                $parts[] = escapeshellarg((string) $value);
                continue;
            }

            if ($value === false || $value === null) {
                continue;
            }

            if ($value === true) {
                $parts[] = escapeshellarg((string) $key);
                continue;
            }

            if (str_starts_with((string) $key, '--')) {
                $parts[] = escapeshellarg((string) $key . '=' . (string) $value);
            } else {
                $parts[] = escapeshellarg((string) $value);
            }
        }

        return implode(' ', $parts);
    }

    private function commandLogPath(string $token): string
    {
        return storage_path('app/command-logs/' . $token . '.log');
    }

    private function ensureCommandLogDirectory(): void
    {
        $directory = storage_path('app/command-logs');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    private function streamArtisanCommand(string $command, array $parameters = [])
    {
        return response()->stream(function () use ($command, $parameters) {
            $this->prepareStream();
            $this->writeStreamLine('Menjalankan: php artisan ' . $command);
            $this->writeStreamLine('Waktu mulai: ' . now()->format('d/m/Y H:i:s'));
            $this->writeStreamLine(str_repeat('-', 72));

            $stream = fopen('php://output', 'w');
            $output = new StreamOutput($stream, OutputInterface::VERBOSITY_NORMAL, false);
            $exitCode = Artisan::call($command, $parameters, $output);

            $this->writeStreamLine('');
            $this->writeStreamLine(str_repeat('-', 72));
            $this->writeStreamLine('Selesai. Exit code: ' . $exitCode);
            $this->writeStreamLine('Waktu selesai: ' . now()->format('d/m/Y H:i:s'));
        }, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    private function streamText(string $text)
    {
        return response()->stream(function () use ($text) {
            $this->prepareStream();
            echo $text;
            @ob_flush();
            flush();
        }, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    private function prepareStream(): void
    {
        @set_time_limit(0);
        @ini_set('output_buffering', 'off');
        @ini_set('zlib.output_compression', '0');

        while (ob_get_level() > 0) {
            @ob_end_flush();
        }
    }

    private function writeStreamLine(string $line): void
    {
        echo $line . PHP_EOL;
        @ob_flush();
        flush();
    }

    /**
     * Remove background from product image using Remove.bg API
     */
    public function removeBackground(Product $product)
    {
        if (!$product->image) {
            return back()->with('error', 'Produk tidak memiliki gambar.');
        }

        $imagePath = storage_path('app/public/' . MediaPath::normalize($product->image));
        
        if (!file_exists($imagePath)) {
            return back()->with('error', 'File gambar tidak ditemukan di server.');
        }

        $keyManager = new \App\Services\RemoveBgKeyManager();
        $apiKey = $keyManager->getAvailableKey();

        if (!$apiKey) {
            return back()->with('error', 'Semua API key Remove.bg sudah habis atau dalam cooldown. Coba lagi nanti.');
        }

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(60)
                ->withHeaders(['X-Api-Key' => $apiKey])
                ->attach('image_file', file_get_contents($imagePath), basename($imagePath))
                ->post('https://api.remove.bg/v1.0/removebg', [
                    'size' => 'auto',
                    'format' => 'png',
                ]);

            if ($response->successful()) {
                $keyManager->recordUsage($apiKey);
                $newFilename = 'products/' . pathinfo($product->image, PATHINFO_FILENAME) . '_nobg.png';
                Storage::disk('public')->put($newFilename, $response->body());
                Storage::disk('public')->delete($product->image);
                $product->update(['image' => $newFilename]);
                return back()->with('success', 'Background berhasil dihapus untuk: ' . $product->name);
            } else {
                $statusCode = $response->status();
                $errorBody = $response->json();
                $errorMsg = $errorBody['errors'][0]['title'] ?? 'Unknown error';
                if ($statusCode === 402) {
                    $keyManager->recordUsage($apiKey);
                    return back()->with('error', "API key limit tercapai ({$errorMsg}). Key akan otomatis berganti.");
                }
                return back()->with('error', "Gagal hapus background: {$errorMsg} (HTTP {$statusCode})");
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('[RemoveBg] Manual remove failed: ' . $e->getMessage());
            return back()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }
}
