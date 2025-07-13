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
    Route::get('/lands', [LandApiController::class, 'index']);
    Route::get('/master', [MasterApiController::class, 'index']);

    Route::get('/banks', [BankApiController::class, 'banks.index']);
    Route::post('/banks', [BankApiController::class, 'store'])->name('banks.store');
    Route::get('/banks/{id}', [BankApiController::class, 'show'])->name('banks.show'); 
    Route::put('/banks/{id}', [BankApiController::class, 'update'])->name('banks.update');
    Route::delete('/banks/{id}', [BankApiController::class, 'destroy'])->name('banks.destroy'); 

    Route::get('/assets', [AssetApiController::class, 'assets.index']);
    Route::post('/assets', [AssetApiController::class, 'store'])->name('assets.store');
    Route::get('/assets/{id}', [AssetApiController::class, 'show'])->name('assets.show'); 
    Route::put('/assets/{id}', [AssetApiController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{id}', [AssetApiController::class, 'destroy'])->name('assets.destroy'); 

    Route::get('/lands', [LandApiController::class, 'lands.index']);
    Route::post('/lands', [LandApiController::class, 'store'])->name('lands.store');
    Route::get('/lands/{id}', [LandApiController::class, 'show'])->name('lands.show'); 
    Route::put('/lands/{id}', [LandApiController::class, 'update'])->name('lands.update');
    Route::delete('/lands/{id}', [LandApiController::class, 'destroy'])->name('lands.destroy'); 
});