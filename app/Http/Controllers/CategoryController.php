<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $service)
    {

    }
    public function index()
    {
        $categories = $this->service->getPaginate(10);
        return CategoryResource::collection($categories)->toArray(request());
    }

    public function create()
    {
        // This method is usually not needed in API context
    }

    public function store(CategoryRequest $request)
    {
        $params = $request->validated();
        $category = $this->service->create($params);
        return [
            'message' => 'Category created successfully.',
            'category' => (new CategoryResource($category))->toArray(request())
        ];
    }

    public function show($id)
    {
        $category = $this->service->show($id);
        return (new CategoryResource($category))->toArray(request());
    }

    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    public function update(CategoryRequest $request, $id)
    {
        $params = $request->validated();
        $category = $this->service->edit($params,$id);

        return [
            'message' => 'Category updated successfully.',
            'category' => (new CategoryResource($category))->toArray(request())
        ];
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return 'Category deleted successfully.';
    }
}
