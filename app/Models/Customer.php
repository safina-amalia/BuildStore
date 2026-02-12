<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'email_verified_at',
        'alamat',
        'no_tlp',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
