<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // <-- PENTING, TAMBAHKAN INI

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-') // Membuat slug otomatis
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Mengupdate kategori di database.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            // Memastikan nama unik, KECUALI untuk ID kategori ini sendiri
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-')
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        // Catatan: Produk di dalam kategori ini TIDAK AKAN HILANG.
        // Berdasarkan migrasi kita, 'category_id' di produk akan otomatis di-set ke NULL.
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}