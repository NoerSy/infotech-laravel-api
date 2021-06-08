<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsolesController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\UserSewaController;
use App\Models\UserSewa;
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

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });

    Route::prefix('users')->group(function () {
        Route::get('all', [UsersController::class, 'show']);
        Route::put('{id}', [UsersController::class, 'update']);
        Route::delete('detele/{id}', [UsersController::class, 'destroy']);
    }); 

    Route::prefix('consoles')->group(function () {
        Route::get('all', [ConsolesController::class, 'show']);
        Route::post('add', [ConsolesController::class, 'add']);
        Route::put('{id}', [ConsolesController::class, 'update']);
        Route::delete('detele/{id}', [ConsolesController::class, 'destroy']);
    }); 

    Route::prefix('pesanan')->group(function () {
        Route::get('all', [UserSewaController::class, 'show']);
        Route::post('new', [UserSewaController::class, 'new']);
        Route::put('diambil', [UserSewaController::class, 'diambil']);
        Route::put('dikembalikan', [UserSewaController::class, 'dikembalikan']);
        Route::delete('detele/{id}', [UserSewaController::class, 'destroy']);
    }); 


    Route::middleware('jwt.verify')->group(function(){
        Route::apiResource('suppliers', SupplierController::class, [
            'as' => 'api'
        ]);
    });
});

Route::any('{any}', function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Resource not found'
    ], 404);
})->where('any', '.*');
