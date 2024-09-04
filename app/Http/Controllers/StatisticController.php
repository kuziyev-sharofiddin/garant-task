<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
//        $name = $request->query('name');
//
//        $branches = Branch::query()
//            ->when($name, function($query, $name) {
//                return $query->where('name', $name);
//            })
//            ->paginate(10);

        $name = $request->input('name');
        $branches = Branch::query()->where('name', 'like', '%' . $name . '%')->paginate(10);
        return response()->json($branches);
    }
}
