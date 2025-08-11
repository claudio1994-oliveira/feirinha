<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo_path',
        'active',
    ];

    public function fairs()
    {
        return $this->belongsToMany(Fair::class)->withPivot(['price', 'quantity', 'sold', 'sold_out'])->withTimestamps();
    }
}
