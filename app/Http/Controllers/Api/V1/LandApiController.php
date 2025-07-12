<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Land;
use Illuminate\Http\Request;

class LandApiController extends Controller
{
    
    public function index()
    {
        $lands = Land::with(['region', 'township'])->get();
        // add pagination info

        return response()->json([
            'message' => 'land list retrieved successfully',
            'data' => $lands,
            'meta' => [
                'total' => $lands->count(),
                'per_page' => 15, // assuming a default per page value
                'current_page' => 1, // assuming current page is 1 for simplicity
            ],
        ]);
    }
}
