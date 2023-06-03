<?php

namespace App\Http\Actions\Web\Products;

use Illuminate\Http\Request;
use App\Models\Web\Product\Product;
use Illuminate\Support\Facades\DB;

class RestockProductAction {
    
    public function handle(Request $request)
    {

        DB::beginTransaction();

        //Get product
        $product = Product::findOrFail($request->product_id);

        //Save product stock
        $save_stock = $this->saveProductStock($request,$product['id']);
        if(!$save_stock)
        {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
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