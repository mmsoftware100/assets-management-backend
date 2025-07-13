<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Land;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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



    /**
     * Store a newly created land record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'building_owner_name' => ['nullable', 'string', 'max:255'],
                'building_type_name' => ['nullable', 'string', 'max:255'],
                'region_id' => ['nullable', 'integer', 'exists:regions,id'],
                'township_id' => ['nullable', 'integer', 'exists:townships,id'],
                'address' => ['nullable', 'string'],
                'year_built' => ['nullable', 'date'],
                'building_design_name' => ['nullable', 'string', 'max:255'],
                'building_size' => ['nullable', 'string', 'max:255'],
                'building_area' => ['nullable', 'string', 'max:255'],
                'land_size' => ['nullable', 'string', 'max:255'],
                'land_area' => ['nullable', 'string', 'max:255'],
                'distributed_fund' => ['nullable', 'numeric', 'min:0'],
                'price' => ['nullable', 'numeric', 'min:0'],
                'is_currently_in_use' => ['nullable', 'boolean'],
                'currently_in_use_note' => ['nullable', 'string'],
                'type_details' => ['nullable', 'string', 'max:255'],
                'is_grant_owned' => ['nullable', 'boolean'],
                'grant_owned_note' => ['nullable', 'string'],
                'life_span' => ['nullable', 'integer', 'min:0'],
                'is_ownership_changed' => ['nullable', 'boolean'],
                'ownership_changed_note' => ['nullable', 'string'],
                'is_land_owned' => ['nullable', 'boolean'],
                'land_owned_note' => ['nullable', 'string'],
                'images' => ['nullable', 'string'],
                'documents' => ['nullable', 'string'],
            ]);

            $land = Land::create($validatedData);

            return response()->json([
                'message' => 'Land record created successfully',
                'data' => $land->load(['region', 'township']) // Load relationships
            ], 201); // 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the land record.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified land record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $land = Land::with(['region', 'township'])->find($id);

        if (!$land) {
            return response()->json([
                'message' => 'Land record not found'
            ], 404); // 404 Not Found
        }

        return response()->json([
            'message' => 'Land record retrieved successfully',
            'data' => $land
        ]);
    }

    /**
     * Update the specified land record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $land = Land::find($id);

            if (!$land) {
                return response()->json([
                    'message' => 'Land record not found'
                ], 404);
            }

            // dd($request->all());

            // Validate the request data
            $validatedData = $request->validate([
                'building_owner_name' => ['sometimes', 'nullable', 'string', 'max:255'],
                'building_type_name' => ['sometimes', 'nullable', 'string', 'max:255'],
                'region_id' => ['sometimes', 'nullable', 'integer', 'exists:regions,id'],
                'township_id' => ['sometimes', 'nullable', 'integer', 'exists:townships,id'],
                'address' => ['sometimes', 'nullable', 'string'],
                'year_built' => ['sometimes', 'nullable', 'date'],
                'building_design_name' => ['sometimes', 'nullable', 'string', 'max:255'],
                'building_size' => ['sometimes', 'nullable', 'string', 'max:255'],
                'building_area' => ['sometimes', 'nullable', 'string', 'max:255'],
                'land_size' => ['sometimes', 'nullable', 'string', 'max:255'],
                'land_area' => ['sometimes', 'nullable', 'string', 'max:255'],
                'distributed_fund' => ['sometimes', 'nullable', 'numeric', 'min:0'],
                'price' => ['sometimes', 'nullable', 'numeric', 'min:0'],
                'is_currently_in_use' => ['sometimes', 'nullable', 'boolean'],
                'currently_in_use_note' => ['sometimes', 'nullable', 'string'],
                'type_details' => ['sometimes', 'nullable', 'string', 'max:255'],
                'is_grant_owned' => ['sometimes', 'nullable', 'boolean'],
                'grant_owned_note' => ['sometimes', 'nullable', 'string'],
                'life_span' => ['sometimes', 'nullable', 'integer', 'min:0'],
                'is_ownership_changed' => ['sometimes', 'nullable', 'boolean'],
                'ownership_changed_note' => ['sometimes', 'nullable', 'string'],
                'is_land_owned' => ['sometimes', 'nullable', 'boolean'],
                'land_owned_note' => ['sometimes', 'nullable', 'string'],
                'images' => ['sometimes', 'nullable', 'string'],
                'documents' => ['sometimes', 'nullable', 'string'],
            ]);

            // dd($validatedData);

            $land->update($validatedData);

            return response()->json([
                'message' => 'Land record updated successfully',
                'data' => $land->load(['region', 'township'])
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the land record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified land record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $land = Land::find($id);

        if (!$land) {
            return response()->json([
                'message' => 'Land record not found'
            ], 404);
        }

        try {
            $land->delete();
            return response()->json([
                'message' => 'Land record deleted successfully'
            ], 200); // 200 OK or 204 No Content
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the land record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    
}
