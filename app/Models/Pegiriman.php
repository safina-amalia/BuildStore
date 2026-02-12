<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'kurir_id',
        'status',
        'tanggal_dikirim',
        'tanggal_diterima'
    ];

    protected $casts = [
        'tanggal_dikirim' => 'datetime',
        'tanggal_diterima' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function kurir()
    {
        return $this->belongsTo(Kurir::class, 'kurir_id');
    }
}
