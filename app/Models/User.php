<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // use HasFactory;
    // protected $primaryKey = 'id_user';
    // public $incrementing = true;
    // protected $keyType = 'int';


    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id');
    }

    public function kurir()
    {
        return $this->hasOne(Kurir::class, 'user_id');
    }
}
