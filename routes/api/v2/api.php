<?php

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

Route::group(
    [
        'prefix' => 'v2',
        'namespace' => 'App\Http\Controllers\Api\V2',
        // 'middleware' => 'auth:sanctum',
    ],
    function () {
        Route::get('/test', function () {
            return response()->json([
                'message' => 'Welcome to the API',
                'api_version' => 'v2',
                'status' => 'success',
            ]);
        });
    }
);
