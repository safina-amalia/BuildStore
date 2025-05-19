<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DetailPesanan extends Model
{
    use HasFactory, Searchable;

    // protected $primaryKey = 'id_detailPesanan';

    protected $fillable = [
        'pesanan_id',
        'product_id',
        'jumlah',
        'harga_satuan',
        'subtotal'
    ];

    public function produk() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}
