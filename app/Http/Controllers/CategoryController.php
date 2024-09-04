<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $service)
    {

    }
    public function index()
    {
        $categories = $this->service->getPaginate(10);
        return response()->json($categories);
    }

    public function create()
    {
        // This method is usually not needed in API context
    }

    public function store(CategoryRequest $request)
    {
        $params = $request->validated();
        $category = $this->service->create($params);
        return response()->json(['message' => 'Category created successfully.', 'category' => $category], 201);
    }

    public function show($id)
    {
        $category = $this->service->show($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }
        return response()->json($category);
    }

    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    public function update(CategoryRequest $request, $id)
    {
        $params = $request->validated();
        $category = $this->service->edit($params,$id);

        return response()->json(['message' => 'Category updated successfully.', 'category' => $category]);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
