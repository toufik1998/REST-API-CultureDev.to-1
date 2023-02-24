<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\resetPasswordController;
use App\Http\Controllers\TagController;

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

//users


Route::post('/user/{user}',[ProfileController::class,'editProfile']);

Route::post('forgot-password', [resetPasswordController::class,'sendResetToken'])->middleware('guest')->name('password.email');
Route::post('reset-password', [resetPasswordController::class,'resetPassword'])->middleware('guest')->name('password.update');
Route::get('reset-password/{token}', function (string $token) {
    return $token;
})->middleware('guest')->name('password.reset');




Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('profile',[AuthController::class,'profile']);
    Route::get('/articles',[ArticleController::class,'index']);
    Route::get('/articles/{id}',[ArticleController::class,'show']);
    Route::post('/articles',[ArticleController::class,'store']);
    Route::post('/articles/{id}',[ArticleController::class,'update']);
    Route::post('/articles/{id}',[ArticleController::class,'destroy']);
    Route::get('/articles/search/{search}',[ArticleController::class,'search']);
    Route::get('categories', [CategoryController::class, 'index']);

});

// Route::group(['middleware'=>'permission:vie article'], function(){

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


//Articles
Route::get('/articles',[ArticleController::class,'index']);
Route::get('/articles/{id}',[ArticleController::class,'show']);
Route::post('/articles',[ArticleController::class,'store']);
Route::put('/articles/{id}',[ArticleController::class,'update']);
Route::delete('/articles/{id}',[ArticleController::class,'destroy']);
Route::get('/articles/search/{search}',[ArticleController::class,'search']);





// Comments
Route::apiResource('comments', CommentController::class);

// Categories
// Route::get('categories', [CategoryController::class, 'index'])
Route::post('categories', [CategoryController::class, 'store']);
Route::get('category/{category}', [CategoryController::class, 'show']);
Route::put('category/{category}', [CategoryController::class, 'update']);
Route::delete('category/{category}', [CategoryController::class, 'destroy']);

// Tags
Route::get('tags', [TagController::class, 'index']);
Route::post('tags', [TagController::class, 'store']);
Route::get('tag/{tag}', [TagController::class, 'show']);
Route::put('tag/{tag}', [TagController::class, 'update']);
Route::delete('tag/{tag}', [TagController::class, 'destroy']);


// Roles
Route::get('roles', [RoleController::class, 'index']);
Route::post('roles', [RoleController::class, 'store']);
Route::get('roles/{role}', [RoleController::class, 'show']);
Route::put('roles/{role}', [RoleController::class, 'update']);
Route::delete('roles/{role}', [RoleController::class, 'destroy']);

