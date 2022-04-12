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

use App\Http\Controllers\ProductController;

Route::post('/Product',[ProductController::class,'store']);
Route::get('/Product',[ProductController::class,'showAll']);
Route::get('/Product/{id}',[ProductController::class,'showById']);
Route::get('/Product/search/product_name={product_name}',[ProductController::class,'showByName']);
Route::put('/Product/{id}',[ProductController::class,'update']);
Route::delete('/Product/{id}',[ProductController::class,'delete']);

