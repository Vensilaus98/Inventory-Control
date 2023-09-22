<?php

namespace App\Models\Web\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
