<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
}
