<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AssetApiController extends Controller
{
    

    public function index()
    {
        $assets = Asset::with(['bank'])->get();
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


    /**
     * Store a newly created asset in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) // Using Request for inline validation
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'bank_id' => ['required', 'integer', 'exists:banks,id'],
                'ministry_name' => ['nullable', 'string', 'max:255'],
                'department_name' => ['nullable', 'string', 'max:255'],
                'machine_name' => ['nullable', 'string', 'max:255'],
                'department_no' => ['nullable', 'string', 'max:255'],
                'brand_name' => ['nullable', 'string', 'max:255'],
                'make_name' => ['nullable', 'string', 'max:255'],
                'model_name' => ['nullable', 'string', 'max:255'],
                'mother_board_name' => ['nullable', 'string', 'max:255'],
                'memory_name' => ['nullable', 'string', 'max:255'],
                'storage_device_name' => ['nullable', 'string', 'max:255'],
                'monitor_name' => ['nullable', 'string', 'max:255'],
                'multi_media_name' => ['nullable', 'string', 'max:255'],
                'number_name' => ['nullable', 'string', 'max:255'],
                'price_name' => ['nullable', 'string', 'max:255'],
                'condition_name' => ['nullable', 'string', 'max:255'],
                'budget_year_name' => ['nullable', 'string', 'max:255'],
                'location_township_name' => ['nullable', 'string', 'max:255'],
                'location_region_name' => ['nullable', 'string', 'max:255'],
                'received_by_name' => ['nullable', 'string', 'max:255'],
                'remark_name' => ['nullable', 'string'],
            ]);

            $asset = Asset::create($validatedData);

            return response()->json([
                'message' => 'Asset created successfully',
                'data' => $asset->load(['bank']) // Load the bank relationship
            ], 201); // 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the asset.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified asset.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $asset = Asset::with(['bank'])->find($id);

        if (!$asset) {
            return response()->json([
                'message' => 'Asset not found'
            ], 404); // 404 Not Found
        }

        return response()->json([
            'message' => 'Asset retrieved successfully',
            'data' => $asset
        ]);
    }

    /**
     * Update the specified asset in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) // Using Request for inline validation
    {
        try {
            $asset = Asset::find($id);

            if (!$asset) {
                return response()->json([
                    'message' => 'Asset not found'
                ], 404);
            }

            // Validate the request data
            $validatedData = $request->validate([
                'bank_id' => ['sometimes', 'required', 'integer', 'exists:banks,id'],
                'ministry_name' => ['nullable', 'string', 'max:255'],
                'department_name' => ['nullable', 'string', 'max:255'],
                'machine_name' => ['nullable', 'string', 'max:255'],
                'department_no' => ['nullable', 'string', 'max:255'],
                'brand_name' => ['nullable', 'string', 'max:255'],
                'make_name' => ['nullable', 'string', 'max:255'],
                'model_name' => ['nullable', 'string', 'max:255'],
                'mother_board_name' => ['nullable', 'string', 'max:255'],
                'memory_name' => ['nullable', 'string', 'max:255'],
                'storage_device_name' => ['nullable', 'string', 'max:255'],
                'monitor_name' => ['nullable', 'string', 'max:255'],
                'multi_media_name' => ['nullable', 'string', 'max:255'],
                'number_name' => ['nullable', 'string', 'max:255'],
                'price_name' => ['nullable', 'string', 'max:255'],
                'condition_name' => ['nullable', 'string', 'max:255'],
                'budget_year_name' => ['nullable', 'string', 'max:255'],
                'location_township_name' => ['nullable', 'string', 'max:255'],
                'location_region_name' => ['nullable', 'string', 'max:255'],
                'received_by_name' => ['nullable', 'string', 'max:255'],
                'remark_name' => ['nullable', 'string'],
            ]);

            $asset->update($validatedData);

            return response()->json([
                'message' => 'Asset updated successfully',
                'data' => $asset->load(['bank'])
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the asset.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified asset from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $asset = Asset::find($id);

        if (!$asset) {
            return response()->json([
                'message' => 'Asset not found'
            ], 404);
        }

        try {
            $asset->delete();
            return response()->json([
                'message' => 'Asset deleted successfully'
            ], 200); // 200 OK or 204 No Content
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the asset.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
