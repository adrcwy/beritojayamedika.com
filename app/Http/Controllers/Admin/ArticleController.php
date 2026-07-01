<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:65535',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content_images' => 'nullable|array',
            'content_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
        }

        $contentImages = $this->storeContentImages($request);

        Article::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'image' => $path,
            'published_at' => $request->input('published_at') ?: now()->toDateString(),
            'content_images' => $contentImages,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:65535',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content_images' => 'nullable|array',
            'content_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'remove_content_images' => 'nullable|array',
            'remove_content_images.*' => 'string',
        ]);

        $path = $article->image;
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $path = $request->file('image')->store('articles', 'public');
        }

        $contentImages = collect($article->content_images ?? [])
            ->reject(fn ($image) => in_array($image, $request->input('remove_content_images', []), true))
            ->values()
            ->all();

        foreach ($request->input('remove_content_images', []) as $image) {
            Storage::disk('public')->delete($image);
        }

        $contentImages = array_merge($contentImages, $this->storeContentImages($request));

        $article->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'image' => $path,
            'published_at' => $request->input('published_at') ?: $article->published_at,
            'content_images' => $contentImages,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        foreach ($article->content_images ?? [] as $image) {
            Storage::disk('public')->delete($image);
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function storeContentImages(Request $request): array
    {
        if (!$request->hasFile('content_images')) {
            return [];
        }

        return collect($request->file('content_images'))
            ->map(fn ($file) => $file->store('articles/content', 'public'))
            ->values()
            ->all();
    }
}
