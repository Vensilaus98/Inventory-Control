<?php

namespace App\Models\Web\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'product_no'
    ];

    public function getAllProducts()
    {

        $products = Product::join('prices', 'prices.product_id', '=', 'products.id')->select('products.id', 'products.name', 'products.product_no', 'prices.amount')->where('prices.is_active', 1)->get();

        //Get the product quantity from stocks
        for ($i = 0; $i < count($products); $i++) {
            //get stock quantity for each product
            $products[$i]['quantity'] = DB::table('stocks')->where(['product_id' => $products[$i]['id']])->where('is_finished', '!=', 1)->whereDate('expiry_date', '>', now())->sum('remaining_quantity');
        }

        return $products;
    }

    public function getSingleProduct($id)
    {
        $product = Product::join('prices', 'prices.product_id', '=', 'products.id')->select('products.id', 'products.name', 'products.product_no', 'prices.amount')->where(['prices.is_active' => 1, 'products.id' => $id])->first();

        //Get the product quantity from stocks
        $product['quantity'] = DB::table('stocks')->where(['product_id' => $product['id']])->where('is_finished', '!=', 1)->whereDate('expiry_date', '>', now())->sum('remaining_quantity');

        return $product;
    }

    public function price($id)
    {
        return $this->join('prices', 'prices.product_id', '=', 'products.id')->where(['prices.is_active' => 1,'prices.product_id' => $id])->first();
    }

    public function stocks($id)
    {
        return $this->join('stocks', 'stocks.product_id', '=', 'products.id')->where(['stocks.is_finished' => 0,'stocks.product_id' => $id])->get();
    }
}
