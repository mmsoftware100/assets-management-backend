<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankApiController extends Controller
{
    public function documentation()
    {
        return response()->json([
            'message' => 'Welcome to the Bank API documentation',
            'version' => 'v1',
        ]);
    }

    public function index()
    {
        $banks = Bank::all();
        // add pagination info

        return response()->json([
            'message' => 'Bank list retrieved successfully',
            'data' => $banks,
            'meta' => [
                'total' => $banks->count(),
                'per_page' => 15, // assuming a default per page value
                'current_page' => 1, // assuming current page is 1 for simplicity
            ],
        ]);
    }
}
