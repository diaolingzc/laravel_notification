<?php

namespace App\Http\Controllers\Api;

use App\CoserCategory;
use App\Http\Resources\CoserCategoryResource;
use Illuminate\Http\Request;

class CoserCategoryController extends Controller
{
    public function index()
    {
        $data = CoserCategory::select('id', 'parent_id', 'name as title', 'level', 'path')->get()->toArray();
        return response()->json(['data' => arr2tree($data, 'id', 'parent_id')]);
    }
}
