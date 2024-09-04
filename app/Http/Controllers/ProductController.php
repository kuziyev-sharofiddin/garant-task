<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $service)
    {

    }
    public function index()
    {
        $products = $this->service->getPaginate(10);
        return ProductResource::collection($products)->toArray(request());
    }

    public function create()
    {
        // This method is usually not needed in API context
    }

    public function store(ProductRequest $request)
    {
        $params = $request->validated();
        $product = $this->service->create($params);
        return response()->json(['message' => 'Product created successfully.', 'product' => $product], 201);
    }

    public function show($id)
    {
        $product = $this->service->show($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
        return response()->json($product);
    }

    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    public function update(ProductRequest $request, $id)
    {
        $params = $request->validated();
        $product = $this->service->edit($params,$id);
        return response()->json(['message' => 'Product updated successfully.', 'product' => $product]);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
