<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        $banks = Bank::with(['region', 'township','bankType'])
        ->withCount('assets')->get();
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

    /**
     * Store a newly created bank in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) // Using Request for inline validation
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'region_id' => ['required', 'integer', 'exists:regions,id'],
                'township_id' => ['required', 'integer', 'exists:townships,id'],
                'bank_type_id' => ['required', 'integer', 'exists:bank_types,id'],
                'latitude' => ['nullable', 'numeric', 'between:-90,90'],
                'longitude' => ['nullable', 'numeric', 'between:-180,180'],
                'address' => ['nullable', 'string', 'max:500'],
            ]);

            $bank = Bank::create($validatedData);

            return response()->json([
                'message' => 'Bank created successfully',
                'data' => $bank->load(['region', 'township', 'bankType'])
            ], 201); // 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            // dd($e);
            return response()->json([
                'message' => 'An error occurred while creating the bank.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified bank.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $bank = Bank::with(['region', 'township', 'bankType'])->find($id);

        if (!$bank) {
            return response()->json([
                'message' => 'Bank not found'
            ], 404); // 404 Not Found
        }

        return response()->json([
            'message' => 'Bank retrieved successfully',
            'data' => $bank
        ]);
    }

    /**
     * Update the specified bank in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) // Using Request for inline validation
    {
        try {
            $bank = Bank::find($id);

            if (!$bank) {
                return response()->json([
                    'message' => 'Bank not found'
                ], 404);
            }

            // Validate the request data
            $validatedData = $request->validate([
                'name' => ['sometimes', 'required', 'string', 'max:255'],
                'region_id' => ['sometimes', 'required', 'integer', 'exists:regions,id'],
                'township_id' => ['sometimes', 'required', 'integer', 'exists:townships,id'],
                'bank_type_id' => ['sometimes', 'required', 'integer', 'exists:bank_types,id'],
                'latitude' => ['nullable', 'numeric', 'between:-90,90'],
                'longitude' => ['nullable', 'numeric', 'between:-180,180'],
                'address' => ['nullable', 'string', 'max:500'],
            ]);

            $bank->update($validatedData);

            return response()->json([
                'message' => 'Bank updated successfully',
                'data' => $bank->load(['region', 'township', 'bankType'])
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the bank.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified bank from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);

        if (!$bank) {
            return response()->json([
                'message' => 'Bank not found'
            ], 404);
        }

        try {
            $bank->delete();
            return response()->json([
                'message' => 'Bank deleted successfully'
            ], 200); // 200 OK or 204 No Content
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the bank.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
