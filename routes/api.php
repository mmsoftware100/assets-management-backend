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


Route::post('/auth/sign-in', function () {
    $data = [
        "accessToken" => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI4ODY0YzcxNy01ODdkLTQ3MmEtOTI5YS04ZTVmMjk4MDI0ZGEtMCIsImlhdCI6MTc1MTY0MzI0NywiZXhwIjoxNzUxOTAyNDQ3fQ.Fbki784HE-JSeSEO_0QB-6V9DNmpcPkbltHPQhSXfVU',
        "user" => [
            "id" => '8864c717-587d-472a-929a-8e5f298024da-0',
            "displayName" => 'Jaydon Frankie',
            "photoURL" => 'https://api-dev-minimal-v6.vercel.app/assets/images/avatar/avatar-25.webp',
            "phoneNumber" => '+1 416-555-0198',
            "country" => 'Canada',
            "address" => '90210 Broadway Blvd',
            "state" => 'California',
            "city" => 'San Francisco',
            "zipCode" => '94116',
            "about" => 'Praesent turpis. Phasellus viverra nulla ut metus varius laoreet. Phasellus tempus.',
            "role" => 'admin',
            "isPublic" => true,
            "email" => 'demo@minimals.cc',
            "password" => '@demo1',
        ],
    ];
    return response()->json($data);
});

Route::post('/auth/me', function () {
    $data = [
        "accessToken" => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI4ODY0YzcxNy01ODdkLTQ3MmEtOTI5YS04ZTVmMjk4MDI0ZGEtMCIsImlhdCI6MTc1MTY0MzI0NywiZXhwIjoxNzUxOTAyNDQ3fQ.Fbki784HE-JSeSEO_0QB-6V9DNmpcPkbltHPQhSXfVU',
        "user" => [
            "id" => '8864c717-587d-472a-929a-8e5f298024da-0',
            "displayName" => 'Jaydon Frankie',
            "photoURL" => 'https://api-dev-minimal-v6.vercel.app/assets/images/avatar/avatar-25.webp',
            "phoneNumber" => '+1 416-555-0198',
            "country" => 'Canada',
            "address" => '90210 Broadway Blvd',
            "state" => 'California',
            "city" => 'San Francisco',
            "zipCode" => '94116',
            "about" => 'Praesent turpis. Phasellus viverra nulla ut metus varius laoreet. Phasellus tempus.',
            "role" => 'admin',
            "isPublic" => true,
            "email" => 'demo@minimals.cc',
            "password" => '@demo1',
        ],
    ];
    return response()->json($data);
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