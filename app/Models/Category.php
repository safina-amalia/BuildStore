<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

// class Category extends Model
// {
//     use Searchable;
// }


class Category extends Model
{
    use HasFactory, Searchable;

    // protected $primaryKey = 'category_id';

    protected $fillable = [
        'name'
    ];

    public function product() {
        return $this->hasMany(Product::class, 'category_id');
    }

     public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
