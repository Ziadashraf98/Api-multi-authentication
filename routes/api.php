<?php

use App\Http\Controllers\Api\Authentication\AdminController;
use App\Http\Controllers\Api\Authentication\UserController;
use App\Http\Controllers\Api\Category\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix'=>'category'] , function () {
    Route::controller(CategoryController::class)->group(function() {

    Route::post('/all_categories' , 'index');
    Route::post('/single_category/{id}' , 'single_category');
    Route::post('/add_category' , 'store');
});
});

Route::group(['prefix'=>'admin'] , function () {
    Route::controller(AdminController::class)->group(function() {

    Route::post('login' , 'login');
    Route::get('/details', 'getDetails');
    Route::post('/logout', 'logout');
});
});

Route::group(['prefix'=>'user'] , function () {
    Route::controller(UserController::class)->group(function() {

    Route::post('login' , 'login');
    Route::post('/logout', 'logout');
});
});