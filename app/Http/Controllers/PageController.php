<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Product;
use App\Models\Article;
use App\Models\Category;
use App\Models\CatalogBook;
use App\Models\FeedbackClient;
use App\Support\MediaPath;
use App\Support\ProductDescriptionCleaner;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Throwable;

class PageController extends Controller
{
    public function home()
    {

        $feedbacks = Schema::hasTable('feedback_clients')
            ? FeedbackClient::query()->inRandomOrder()->get()
            : collect();

        $latestArticles = Schema::hasTable('articles')
            ? Article::query()
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->take(3)
                ->get()
            : collect();
        
    return view('pages.home', compact('feedbacks', 'latestArticles'));
    }

public function about()
{
    return view('pages.about'); 
}

public function toocare()
{
    return view('pages.toocare'); 
}

public function catalogBook()
{
    $catalogBooks = Schema::hasTable('catalog_books')
        ? CatalogBook::query()
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get()
        : collect();

    $featuredCatalog = $catalogBooks->first();

    return view('pages.catalog-book', compact('catalogBooks', 'featuredCatalog'));
}

public function products(Request $request)
    {
        try {
            $query = Product::query()
                ->select('id', 'name', 'description', 'image', 'category_id', 'catalog_link', 'is_active', 'created_at')
                ->where('is_active', true)
                ->with(['category:id,name']);

            // Logika Pencarian
            if ($request->filled('search')) {
                $search = $this->cleanText($request->input('search'));
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                });
            }

            if ($request->filled('category') && $request->input('category') !== 'all') {
                $query->where('category_id', $request->input('category'));
            }

            if ($request->input('inaproc') === 'registered') {
                $query->whereNotNull('catalog_link')->where('catalog_link', '!=', '');
            }

            if ($request->input('inaproc') === 'unregistered') {
                $query->where(function ($query) {
                    $query->whereNull('catalog_link')->orWhere('catalog_link', '');
                });
            }
            
            $products = $query->latest()
                ->paginate(24)
                ->withQueryString()
                ->through(function (Product $product) {
                    $description = ProductDescriptionCleaner::clean($product->description);

                    return (object) [
                        'id' => $product->id,
                        'name' => $this->cleanText($product->name),
                        'description' => $description,
                        'description_is_truncated' => ProductDescriptionCleaner::looksTruncated($description),
                        'image' => $this->cleanPath($product->image),
                        'category_id' => $product->category_id,
                        'catalog_link' => $this->cleanUrl($product->catalog_link),
                        'is_active' => $product->is_active,
                        'created_at' => $product->created_at,
                        'category_name' => $product->category ? $this->cleanText($product->category->name) : '-',
                    ];
                });

            $categories = Category::select('id', 'name')
                ->orderBy('name')
                ->get()
                ->map(fn (Category $category) => [
                    'id' => $category->id,
                    'name' => $this->cleanText($category->name),
                ])
                ->values();
        } catch (Throwable $e) {
            Log::error('[ProductsPage] Failed to load products: ' . $e->getMessage());

            $products = new LengthAwarePaginator([], 0, 24, 1, [
                'path' => $request->url(),
            ]);
            $categories = collect();
        }

        return view('pages.products', compact('products', 'categories'));   
    }

    private function cleanText(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        $value = strip_tags($value);

        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'UTF-8//IGNORE', $value);
            if ($converted !== false) {
                $value = $converted;
            }
        }

        $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value) ?? '';

        return trim($value);
    }

    private function cleanPath(?string $value): string
    {
        $value = $this->cleanText($value);

        return filter_var($value, FILTER_VALIDATE_URL) ? $value : MediaPath::normalize($value);
    }

    private function cleanUrl(?string $value): string
    {
        $value = $this->cleanText($value);

        return filter_var($value, FILTER_VALIDATE_URL) ? $value : '';
    }

    public function projects()
    {
        $projects = Project::all(); // Ambil semua data proyek
        return view('pages.projects', compact('projects'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function articles()
    {
        $articles = Article::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('pages.articles', compact('articles'));
    }

    public function articleShow(Article $article)
    {
        $relatedArticles = Article::query()
            ->whereKeyNot($article->id)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('pages.article-show', compact('article', 'relatedArticles'));
    }
}
