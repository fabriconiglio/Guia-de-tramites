<?php

use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\TramiteController;
use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/areas/{area}', [AreaController::class, 'show']);
Route::middleware('auth:sanctum')->get('/categories', [CategorieController::class, 'index']);
Route::middleware('auth:sanctum')->get('/tramites/{slug}', [TramiteController::class, 'show']);
Route::middleware('auth:sanctum')->get('/tramites', [TramiteController::class, 'index']);
