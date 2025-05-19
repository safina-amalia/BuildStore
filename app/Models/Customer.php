<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory, Searchable;

    // protected $primaryKey = 'id_customer';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'alamat',
        'no_tlp'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pesanan() {
        return $this->hasMany(Pesanan::class, 'customer_id');
    }

    public function pembayaran() {
        return $this->hasMany(Pembayaran::class, 'customer_id');
    }

    public function pengiriman() {
        return $this->hasMany(Pengiriman::class, 'customer_id');
    }
}
