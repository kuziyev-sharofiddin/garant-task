<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Services\StoreService;

class StoreController extends Controller
{
    public function __construct(private readonly StoreService $service)
    {

    }

    public function index()
    {
        $stores = $this->service->getPaginate(10);
        return response()->json($stores);
    }

    public function create()
    {
        // This method is usually not needed in API context
    }

    public function store(StoreRequest $request)
    {
        $params = $request->validated();
        $this->service->insert($params);
        $stores = $this->service->getPaginate(10);

        return response()->json([
            'stores' => $stores,
            'message' => 'Data successfully saved.'
        ], 201);
    }

    public function show($id)
    {
        $store = $this->service->show($id);

        if (!$store) {
            return response()->json(['message' => 'Store not found.'], 404);
        }
        return response()->json($store);
    }

    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    public function update(StoreRequest $request, $id)
    {
        $params = $request->validated();
        $store = $this->service->edit($params,$id);
        return response()->json(['message' => 'Store updated successfully.', 'store' => $store]);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Store deleted successfully.']);
    }
}
