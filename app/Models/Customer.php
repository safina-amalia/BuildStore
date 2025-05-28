<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
<<<<<<< HEAD
        // 'email',
        // 'password',
=======
        'email',
        'password',
        'email_verified_at',
>>>>>>> 423fe2a09e74310352221c0c481cb2111a1b057f
        'alamat',
        'no_tlp',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
