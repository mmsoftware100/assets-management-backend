<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetApiController extends Controller
{
    

    public function index()
    {
        $assets = Asset::all();
        // add pagination info

        return response()->json([
            'message' => 'asset list retrieved successfully',
            'data' => $assets,
            'meta' => [
                'total' => $assets->count(),
                'per_page' => 15, // assuming a default per page value
                'current_page' => 1, // assuming current page is 1 for simplicity
            ],
        ]);
    }
}
