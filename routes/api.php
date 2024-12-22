<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ControllerForForm;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/admin')->group(function(){
    Route::apiResource('/categories', CategoryController::class);

    Route::controller(ControllerForForm::class)->group(function(){
            Route::get('parentCategories', 'parentCategories');
            Route::get('allCategories', 'allCategories');
    });
    Route::apiResource('/products', ProductController::class);


});