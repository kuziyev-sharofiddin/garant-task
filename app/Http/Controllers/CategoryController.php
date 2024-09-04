<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
// Display a listing of the categories
    public function index()
    {
        $categories = Category::query()->paginate(10);
        return response()->json($categories);
    }

    // Show the form for creating a new category (Not used in API, typically for web apps)
    public function create()
    {
        // This method is usually not needed in API context
    }

    // Store a newly created category in storage
    public function store(CategoryRequest $request)
    {
        $params = $request->validated();

        // Create the category
        $category = Category::query()->create($params);

        return response()->json(['message' => 'Category created successfully.', 'category' => $category], 201);
    }

    // Display the specified category
    public function show($id)
    {
        $category = Category::query()->findOrFail($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }
        return response()->json($category);
    }

    // Show the form for editing the specified category (Not used in API, typically for web apps)
    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    // Update the specified category in storage
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::query()->findOrFail($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }
        $params = $request->validated();
        $category->name = $params['name'];
        $category->save();

        return response()->json(['message' => 'Category updated successfully.', 'category' => $category]);
    }

    // Remove the specified category from storage
    public function destroy($id)
    {
        $category = Category::query()->findOrFail($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
