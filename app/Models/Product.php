<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'product_id');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'product_id');
    }

    /**
     * Kolom yang digunakan untuk pencarian fulltext oleh Laravel Scout.
     */
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%$term%")
            ->orWhere('description', 'like', "%$term%");
        });
    }

}
