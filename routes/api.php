<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PassportController;
use Database\Factories\CategoryFactory;
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

Route::middleware('auth:api')->prefix('v1')->group(function(){

//resful API -> menggnakan semua method
Route::get('/posts',[ArticleController::class,'index']);
Route::get('/posts/{id}',[ArticleController::class,'show']);
Route::post('/posts/create',[ArticleController::class,'store']);
Route::patch('/posts/{id}',[ArticleController::class,'update']);
Route::delete('/posts/{id}',[ArticleController::class,'destroy']);

//category
Route::get('/category',[CategoryController::class,'index']);
Route::get('/categoty/{id}',[CategoryController::class,'show']);
Route::post('/category/crate',[CategoryController::class,'store']);
Route::patch('/category/{id}',[CategoryController::class,'update']);
Route::delete('/category/{id}',[CategoryFactory::class,'destroy']);

});
Route::post('/login',[PassportController::class,'login']);
Route::middleware('auth:api')->get('/all',[PassportController::class,'users']);
Route::get('/all', [PassportController::class, 'users']);
//resful API -> menggnakan semua method


