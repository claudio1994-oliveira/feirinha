<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fair extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_date',
        'is_current',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['price', 'quantity', 'sold', 'sold_out'])
            ->withTimestamps();
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }
}
