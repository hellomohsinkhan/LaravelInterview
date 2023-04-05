<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController; 
use App\Http\Controllers\API\CategoryController;
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

Route::post('register',[PassportAuthController::class,'registerUser']);
Route::post('login',[PassportAuthController::class,'loginUser']);
//add this middleware to ensure that every request is authenticated
Route::middleware('auth:api')->group(function(){    
  
    // for User routes
    Route::get('category',[CategoryController::class,'index']);
    //for products
    Route::get('catProduct/{id}',[CategoryController::class,'catProduct']);
    Route::get('product/{id}',[CategoryController::class,'show']);
    Route::get('productSearch/{title}',[CategoryController::class,'search']);   
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
