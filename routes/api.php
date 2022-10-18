<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/product',[ProductController::class,'index']);
Route::get('/product/{id}',[ProductController::class,'show']);
Route::post('/product',[ProductController::class,'create']);
Route::put('/product/edit/{id}',[ProductController::class,'update']);
// Route::delete('/product/{id}',[ProductController::class,'delete']);
Route::delete('/product/{id}',[ProductController::class,'destroy']);
// Route::get('/hello', [HelloController::class,'index']);

/**Users */
Route::get('/user',[UserController::class,'index']);
Route::get('/user/{id}',[UserController::class,'show']);
Route::post('/user',[UserController::class,'store']);
Route::put('/user/edit/{id}',[UserController::class,'update']);
Route::delete('/user/{id}',[UserController::class,'destroy']);

/**Orders */
Route::get('/order',[OrderController::class,'index']);
Route::get('/order/{id}',[OrderController::class,'show']);
Route::post('/order/create',[OrderController::class,'store']);