<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Kurir extends Model
{
    use HasFactory, Searchable;

    // protected $primaryKey = 'id_kurir';

    protected $fillable = [
        'user_id',
        'nama',
        'no_tlp'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengiriman() {
        return $this->hasMany(Pengiriman::class, 'kurir_id');
    }
}
