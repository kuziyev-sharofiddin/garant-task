<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
use App\Services\StoreService;

class StoreController extends Controller
{
    public function __construct(private readonly StoreService $service)
    {

    }

    public function index()
    {
        $stores = $this->service->getPaginate(10);
        return StoreResource::collection($stores)->toArray(request());
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

        return [
            'stores' => StoreResource::collection($stores)->toArray(request()),
            'message' => 'Data successfully saved.'
        ];
    }

    public function show($id)
    {
        $store = $this->service->show($id);
        return (new StoreResource($store))->toArray(request());
    }

    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    public function update(StoreRequest $request, $id)
    {
        $params = $request->validated();
        $store = $this->service->edit($params,$id);
        return [
            'message' => 'Store updated successfully.',
            'store' => (new StoreResource($store))->toArray(request())
        ];
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return 'Store deleted successfully.';
    }
}
