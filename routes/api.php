<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PassportController;
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
Route::get('/posts',[ArticleController::class,'index']);
Route::get('/posts/{id}',[ArticleController::class,'show']);
Route::post('/posts/create',[ArticleController::class,'store']);
Route::patch('/posts/{id}',[ArticleController::class,'update']);
//resful API -> menggnakan semua method
Route::delete('/posts/{id}',[ArticleController::class,'destroy']);

});
Route::post('/login',[PassportController::class,'login']);
Route::middleware('auth:api')->get('/all',[PassportController::class,'users']);
Route::get('/all', [PassportController::class, 'users']);
//resful API -> menggnakan semua method


