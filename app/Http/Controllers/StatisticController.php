<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        $branches = Branch::query()->where('name', 'like', '%' . $name . '%')->paginate(10);
        return BranchResource::collection($branches)->toArray(request());
    }
}
