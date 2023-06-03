<?php

namespace App\Http\Controllers\Web\Product;

use App\Http\Actions\Web\Products\SaveProductAction;
use App\Http\Actions\Web\Products\RestockProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Product\SaveProductRequest;
use App\Http\Requests\Web\Product\RestockProductRequest;
use Illuminate\Http\Request;
use App\Models\Web\Product\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $products = $product->getAllProducts();

        return view('web.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProductRequest $request,SaveProductAction $saveProductAction)
    {
        $saveProduct = $saveProductAction->handle($request);
        if(!$saveProduct)
        {
            return redirect()->route('products.index')->with('error', 'Failed to create new product');
        }

        return redirect()->route('products.index')->with('status', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function restock(Request $request,Product $product)
    {

        $data = $request->all();
        
        //Get product
        $product = $product->getSingleProduct($data['id']);

        return response()->json($product);
    }

    public function storeRestock(RestockProductRequest $request, RestockProductAction $productAction){
        
        //Restock product
        $restockProduct = $productAction->handle($request);
        if(!$restockProduct)
        {
            return redirect()->route('products.index')->with('error', 'Failed to restock product');
        }

        return redirect()->route('products.index')->with('status', 'Product restocked successfully');
    }
}
