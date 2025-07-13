<?php

use App\Http\Controllers\Api\V1\AssetApiController;
use App\Http\Controllers\Api\V1\BankApiController;
use App\Http\Controllers\Api\V1\LandApiController;
use App\Http\Controllers\Api\V1\MasterApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    // Login Route
    Route::get('', [BankApiController::class, 'documentation']);
    Route::get('/banks', [BankApiController::class, 'index']);
    Route::get('/assets', [AssetApiController::class, 'index']);
    Route::get('/lands', [LandApiController::class, 'index']);
    Route::get('/master', [MasterApiController::class, 'index']);

    Route::post('banks', [BankApiController::class, 'store'])->name('banks.store');
    Route::get('banks/{id}', [BankApiController::class, 'show'])->name('banks.show'); 
    Route::put('banks/{id}', [BankApiController::class, 'update'])->name('banks.update');
    Route::delete('banks/{id}', [BankApiController::class, 'destroy'])->name('banks.destroy'); 
});