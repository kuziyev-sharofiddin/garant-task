<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // Display a listing of the categories
    public function index()
    {
        $stores = Store::query()->paginate(10);
        return response()->json($stores);
    }

    // Show the form for creating a new category (Not used in API, typically for web apps)
    public function create()
    {
        // This method is usually not needed in API context
    }

    // Store a newly created category in storage
    public function store(StoreRequest $request)
    {
        $params = $request->validated();

        Store::query()->insert($params);
        $stores = Store::query()->paginate(10);

        return response()->json([
            'stores' => $stores,
            'message' => 'Data successfully saved.'
        ], 201);
    }

    // Display the specified category
    public function show($id)
    {
        $store = Store::query()->findOrFail($id);

        if (!$store) {
            return response()->json(['message' => 'Store not found.'], 404);
        }
        return response()->json($store);
    }

    // Show the form for editing the specified category (Not used in API, typically for web apps)
    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    // Update the specified category in storage
    public function update(StoreRequest $request, $id)
    {
        $store = Store::query()->findOrFail($id);

        if (!$store) {
            return response()->json(['message' => 'Store not found.'], 404);
        }
        $params = $request->validated();
        $store->product_id = $params['product_id'];
        $store->quantity = $params['quantity'];
        $store->price = $params['price'];
        $store->branch_id = $params['branch_id'];
        $store->save();

        return response()->json(['message' => 'Store updated successfully.', 'store' => $store]);
    }

    // Remove the specified category from storage
    public function destroy($id)
    {
        $store = Store::query()->findOrFail($id);

        if (!$store) {
            return response()->json(['message' => 'Store not found.'], 404);
        }

        $store->delete();
        return response()->json(['message' => 'Store deleted successfully.']);
    }
}
