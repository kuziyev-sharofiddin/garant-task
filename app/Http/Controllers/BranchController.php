<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Display a listing of the categories
    public function index()
    {
        $branches = Branch::query()->paginate(10);
        return response()->json($branches);
    }

    // Show the form for creating a new category (Not used in API, typically for web apps)
    public function create()
    {
        // This method is usually not needed in API context
    }

    // Store a newly created category in storage
    public function store(BranchRequest $request)
    {
        $params = $request->validated();

        // Create the category
        $branch = Branch::query()->create($params);

        return response()->json(['message' => 'Branch created successfully.', 'branch' => $branch], 201);
    }

    // Display the specified category
    public function show($id)
    {
        $branch = Branch::query()->findOrFail($id);

        if (!$branch) {
            return response()->json(['message' => 'Branch not found.'], 404);
        }
        return response()->json($branch);
    }

    // Show the form for editing the specified category (Not used in API, typically for web apps)
    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    // Update the specified category in storage
    public function update(BranchRequest $request, $id)
    {
        $branch = Branch::query()->findOrFail($id);

        if (!$branch) {
            return response()->json(['message' => 'Branch not found.'], 404);
        }
        $params = $request->validated();
        $branch->name = $params['name'];
        $branch->product_id = $params['product_id'];
        $branch->quantity = $params['quantity'];
        $branch->price = $params['price'];
        $branch->summ = $params['summ'];
        $branch->save();

        return response()->json(['message' => 'Branch updated successfully.', 'branch' => $branch]);
    }

    // Remove the specified category from storage
    public function destroy($id)
    {
        $branch = Branch::query()->findOrFail($id);

        if (!$branch) {
            return response()->json(['message' => 'Branch not found.'], 404);
        }

        $branch->delete();
        return response()->json(['message' => 'Branch deleted successfully.']);
    }
}
