<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    // Display a listing of the categories
    public function index()
    {
        $products = Product::query()->paginate(10);
        return response()->json($products);
    }

    // Show the form for creating a new category (Not used in API, typically for web apps)
    public function create()
    {
        // This method is usually not needed in API context
    }

    // Store a newly created category in storage
    public function store(ProductRequest $request)
    {
        $params = $request->validated();

        // Create the category
        $product = Product::query()->create($params);

        return response()->json(['message' => 'Product created successfully.', 'product' => $product], 201);
    }

    // Display the specified category
    public function show($id)
    {
        $product = Product::query()->findOrFail($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
        return response()->json($product);
    }

    // Show the form for editing the specified category (Not used in API, typically for web apps)
    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    // Update the specified category in storage
    public function update(ProductRequest $request, $id)
    {
        $product = Product::query()->findOrFail($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
        $params = $request->validated();
        $product->name = $params['name'];
        $product->category_id = $params['category_id'];
        $product->quantity = $params['quantity'];
        $product->price = $params['price'];
        $product->save();

        return response()->json(['message' => 'Product updated successfully.', 'product' => $product]);
    }

    // Remove the specified category from storage
    public function destroy($id)
    {
        $product = Product::query()->findOrFail($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
