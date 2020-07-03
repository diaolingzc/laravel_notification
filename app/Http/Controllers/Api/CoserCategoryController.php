<?php

namespace App\Http\Controllers\Api;

use App\CoserCategory;

class CoserCategoryController extends Controller
{
    public function index()
    {
        $data = CoserCategory::select('id', 'parent_id', 'name as title', 'level', 'path')->get()->toArray();

        return response()->json(['data' => arr2tree($data, 'id', 'parent_id')]);
    }
}
