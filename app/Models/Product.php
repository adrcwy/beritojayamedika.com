<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
        'catalog_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Produk milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
