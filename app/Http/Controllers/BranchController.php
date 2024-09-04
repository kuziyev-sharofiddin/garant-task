<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Http\Resources\BranchResource;
use App\Services\BranchService;

class BranchController extends Controller
{

    public function __construct(private readonly BranchService $service)
    {

    }
    public function index()
    {
        $branches = $this->service->getPaginate(10);
        return BranchResource::collection($branches)->toArray(request());
    }

    public function create()
    {
        // This method is usually not needed in API context
    }

    public function store(BranchRequest $request)
    {
        $params = $request->validated();
        $branch = $this->service->create($params);
        return [
            'message' => 'Branch created successfully.',
            'branch' => (new BranchResource($branch))->toArray(request())
        ];
    }

    public function show($id)
    {
        $branch = $this->service->show($id);
        return (new BranchResource($branch))->toArray(request());
    }

    public function edit($id)
    {
        // This method is usually not needed in API context
    }

    public function update(BranchRequest $request, $id)
    {
        $params = $request->validated();
        $branch = $this->service->edit($params,$id);
        return [
            'message' => 'Branch updated successfully.',
            'branch' => (new BranchResource($branch))->toArray(request())
        ];
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return 'Branch deleted successfully.';
    }
}

