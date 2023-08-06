<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// isian alan
use App\Http\Controllers\ProductController;

//buat manggil routes tapi dikelompokan
Route::get('/products/list', [ProductController::class, 'index']);
Route::get('/products/detail/{id}', [ProductController::class, 'show']);
Route::post('/products/add', [ProductController::class, 'add']);
Route::put('/products/edit/{id}', [ProductController::class, 'edit']);
Route::delete('/products/delete/{id}', [ProductController::class, 'delete']);
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
