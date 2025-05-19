<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id_pengiriman';

    protected $fillable = [
        'pesanan_id',
        'customer_id',
        'kurir_id',
        'status_pengiriman'
    ];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function kurir() {
        return $this->belongsTo(Kurir::class, 'kurir_id');
    }
}
