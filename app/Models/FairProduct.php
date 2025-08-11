<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FairProduct extends Model
{
    use HasFactory;

    protected $table = 'fair_product';

    protected $fillable = [
        'fair_id',
        'product_id',
        'price',
        'quantity',
        'sold',
        'sold_out',
    ];

    public function fair()
    {
        return $this->belongsTo(Fair::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
