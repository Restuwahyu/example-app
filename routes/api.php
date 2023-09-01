<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'peminjaman'], function(){
    Route::get('/', [PeminjamanController::class, 'index']);
    Route::post('/', [PeminjamanController::class, 'store']);
    Route::group(['prefix' => '{id_peminjam}'], function(){
        Route::get('/', [PeminjamanController::class, 'destroy']);
        Route::get('/', [PeminjamanController::class, 'update']);
    });
});