<?php

namespace App\Models\Web\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Web\Product\Product;

class Stock extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
}
