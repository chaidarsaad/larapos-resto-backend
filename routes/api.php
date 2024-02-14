<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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

// login
Route::post('/login', [AuthController::class, 'login']);

// logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// get all users data
Route::middleware('auth:sanctum')->get('/getusers', [AuthController::class, 'getAllUserData']);


// logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// default sanctum protection
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUserData']);

// get all categories
Route::middleware('auth:sanctum')->get('/categories', [CategoryController::class, 'all']);

// get all products
Route::middleware('auth:sanctum')->get('/products', [ProductController::class, 'all']);
