<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BankType;
use App\Models\Region;
use App\Models\Township;
use Illuminate\Http\Request;

class MasterApiController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        $townships = Township::all();
        $bankTypes = BankType::all();

        $data = [
            'regions' => $regions,
            'townships' => $townships,
            'bank_types' => $bankTypes,
        ];
        // add pagination info

        return response()->json([
            'message' => 'master data retrieved successfully',
            'data' => $data,
            'meta' => [
                'total' => [
                    'region_count' => $regions->count(),
                    'township_count' => $townships->count(),
                    'bank_type_count' => $bankTypes->count(),
                ],
            ],
        ]);
    }
}
