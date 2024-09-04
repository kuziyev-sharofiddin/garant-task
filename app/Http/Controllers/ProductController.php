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
        return
            [
                'message' => 'Product created successfully.',
                'product' => (new ProductResource($product))->toArray(request())
            ];
    }

    public function show($id)
    {
        $product = $this->service->show($id);
        return (new ProductResource($product))->toArray(request());
    }

    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    public function update(ProductRequest $request, $id)
    {
        $params = $request->validated();
        $product = $this->service->edit($params,$id);
        return response()->json([
            'message' => 'Product updated successfully.',
            'product' => (new ProductResource($product))->toArray(request())
        ]);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return 'Product deleted successfully.';
    }
}
