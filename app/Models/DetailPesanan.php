<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'product_id',
        'qty',
        'harga_satuan',
        'subtotal'
    ];

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relasi ke pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}
