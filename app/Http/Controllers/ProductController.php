<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Filters\ProductFilter;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_query = Product::withFilter(new ProductFilter, $request)->orderBy('id', 'DESC')->paginate($request->query('limit'));
        return response()->json($product_query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->fill($request->all());
        if ($product->save()) {
            return response()->json(['message' => 'Product Created Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->all());
        if ($product->save()) {
            return response()->json(['message' => 'Product Updated Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Product::destroy($id)) {
            return response()->json(['message' => 'Product has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
