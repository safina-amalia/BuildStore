<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'customer_id',
        'pesanan_id',
        'metode'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}
