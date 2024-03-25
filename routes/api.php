<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientEditController;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    // Route::resource('client-edit', ClientEditController::class);
    Route::post('/logout', [CustomAuthController::class, 'logout']);
});
// Public routes
Route::get('/clients/{id}', [ClientController::class, 'getClientById']);
Route::resource('clients', ClientController::class);
Route::post('/register', [CustomAuthController::class, 'customRegistration']);
Route::get('/dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('/status', [CustomAuthController::class, 'status']);
Route::post('/login', [CustomAuthController::class, 'customLogin']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
