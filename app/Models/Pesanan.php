<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Pesanan extends Model
{
    use HasFactory, Searchable;

    // protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'customer_id',
        'product_id',
        'status',
        'total'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'icustomer_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function pembayaran() {
        return $this->hasOne(Pembayaran::class, 'pesanan_id');
    }

    public function pengiriman() {
        return $this->hasOne(Pengiriman::class, 'pesanan_id');
    }

    public function detailPesanan() {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }
}
