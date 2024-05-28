<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CoreMemberController;
use App\Http\Controllers\Api\Guest\AreaController;
use App\Http\Controllers\Api\Guest\CategoryController;
use App\Http\Controllers\Api\Guest\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ResetPasswordController;
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

// register
Route::post('/register', [UserController::class, 'register']);
// login
Route::post('/login', [UserController::class, 'login']);

Route::post('/change-password', [ResetPasswordController::class, 'changePassword']);
Route::post('/forgot-password', [ResetPasswordController::class, 'forgotPassword']);

// get all category
Route::get('/category', [CategoryController::class, 'index']);

// get all area
Route::get('/area', [AreaController::class, 'index']);

// get company
Route::resource('company', CompanyController::class)->only(['index', 'show']);

// get company highlight (query là Viet Nam hoặc Japan)
Route::get('/highlight', [CompanyController::class, 'highlight']);

// product
Route::resource('product', ProductController::class)->only(['show']);

// core member
Route::resource('member', CoreMemberController::class)->only(['show']);

Route::middleware('auth:sanctum')->group(function () {
    // update company
    Route::resource('company', CompanyController::class)->only(['update']);

    // update, delete product
    Route::resource('product', ProductController::class)->only(['store','update', 'destroy']);

    // update, delete core member
});
Route::resource('member', CoreMemberController::class)->only(['store', 'update', 'destroy']);