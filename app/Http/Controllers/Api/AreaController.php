<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Response;

class AreaController extends Controller
{
    public function show($id)
    {
        $area = Area::with('parent', 'children')->find($id);

        if (!$area) {
            return response()->json(['error' => 'Area not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($area);
    }
}
