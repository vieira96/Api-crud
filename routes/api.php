<?php

use App\Http\Controllers\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/product', [ProductController::class, 'store']);

Route::delete('/product/{product}/delete', [ProductController::class, 'delete']);
Route::get('/product/{product}', [ProductController::class, 'getProduct']);
Route::put('/product/{product}/edit', [ProductController::class, 'edit']);