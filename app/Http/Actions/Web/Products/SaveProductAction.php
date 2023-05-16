<?php

namespace App\Http\Actions\Web\Products;

use Illuminate\Http\Request;
use App\Models\Web\Product\Product;
use Illuminate\Support\Facades\DB;

class SaveProductAction {
    
    public function handle(Request $request)
    {

        DB::beginTransaction();

        //save product
        $product_id = Product::create([
            'name' => $request->name,
            'product_no' => 'PRD-'.hrtime()[1]
        ])->id;

        if(!$product_id)
        {
            DB::rollBack();
            return false;
        }

        //Save product price
        $save_price = $this->saveProductPrice($request,$product_id);
        if(!$save_price)
        {
            DB::rollBack();
            return false;
        }

        //Save product stock
        $save_stock = $this->saveProductStock($request,$product_id);
        if(!$save_stock)
        {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }

    private function saveProductPrice($request,$product_id)
    {
        return DB::table('prices')->insert(['product_id' =>$product_id,'amount' => $request->price]);
    }

    private function saveProductStock($request,$product_id)
    {
        return DB::table('stocks')->insert([
            'product_id' =>$product_id,
            'stock_no' => 'STCK-'.hrtime()[1],
            'batch_no' => 'BTC-'.hrtime()[1],
            'quantity' => $request->quantity,
            'remaining_quantity' => $request->quantity,
            'expiry_date' => $request->expiry,
            'is_finished' => 0
        ]);
    }
}