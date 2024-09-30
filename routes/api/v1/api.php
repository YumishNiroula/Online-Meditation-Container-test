<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\LogController;

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

Route::post('v1/login', [AuthController::class, 'login']);


Route::group(
    [
        'prefix' => 'v1',
        'namespace' => 'App\Http\Controllers\Api\V1',
        'middleware' => 'auth:sanctum',
    ],
    function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::apiResource('logs', LogController::class);

        Route::get('/test', function () {
            return response()->json([
                'message' => 'Welcome to the API',
                'api_version' => 'v1',
                'status' => 'success',
            ]);
        });
    }
);
