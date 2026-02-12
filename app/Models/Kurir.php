<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Kurir extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'no_tlp',
    ];

    // Jika kamu ingin hash password secara otomatis saat diset
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Misalnya relasi ke pengiriman
    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class, 'kurir_id');
    }
}
