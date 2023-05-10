<?php

namespace App\Models\Web\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getAllProducts(){
        return Product::all();
    }
}
