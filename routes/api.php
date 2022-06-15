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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'posts'], function (){
    Route::get('/',\App\Http\Controllers\Api\Post\IndexController::class);
    Route::get('/{post}',\App\Http\Controllers\Api\Post\ShowController::class);
    Route::post('/',\App\Http\Controllers\Api\Post\StoreController::class);
    Route::patch('/{post}',\App\Http\Controllers\Api\Post\UpdateController::class);
    Route::delete('/{post}',\App\Http\Controllers\Api\Post\DeleteController::class);
});

Route::group(['prefix' => 'categories'], function (){
    Route::get('/',\App\Http\Controllers\Api\Category\IndexController::class);
});
