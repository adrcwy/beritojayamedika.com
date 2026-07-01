<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogBook;
use App\Support\MediaPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogBookController extends Controller
{
    public function index()
    {
        $catalogBooks = CatalogBook::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.catalog-books.index', compact('catalogBooks'));
    }

    public function create()
    {
        return view('admin.catalog-books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'pdf_path' => 'required|file|mimes:pdf|max:512000',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'published_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        $data['pdf_path'] = $request->file('pdf_path')->store('catalog-books', 'public');
        $data['cover_image'] = $request->hasFile('cover_image')
            ? $request->file('cover_image')->store('catalog-books/covers', 'public')
            : null;
        $data['is_active'] = $request->boolean('is_active', true);

        CatalogBook::create($data);

        return redirect()->route('catalog-books.index')->with('success', 'Katalog berhasil ditambahkan.');
    }

    public function edit(CatalogBook $catalogBook)
    {
        return view('admin.catalog-books.edit', compact('catalogBook'));
    }

    public function update(Request $request, CatalogBook $catalogBook)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'pdf_path' => 'nullable|file|mimes:pdf|max:512000',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'published_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('pdf_path')) {
            $this->deleteMedia($catalogBook->pdf_path);
            $data['pdf_path'] = $request->file('pdf_path')->store('catalog-books', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $this->deleteMedia($catalogBook->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('catalog-books/covers', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $catalogBook->update($data);

        return redirect()->route('catalog-books.index')->with('success', 'Katalog berhasil diperbarui.');
    }

    public function destroy(CatalogBook $catalogBook)
    {
        $this->deleteMedia($catalogBook->pdf_path);
        $this->deleteMedia($catalogBook->cover_image);
        $catalogBook->delete();

        return redirect()->route('catalog-books.index')->with('success', 'Katalog berhasil dihapus.');
    }

    private function deleteMedia(?string $path): void
    {
        $path = MediaPath::normalize($path);

        if ($path !== '') {
            Storage::disk('public')->delete($path);
        }
    }
}
