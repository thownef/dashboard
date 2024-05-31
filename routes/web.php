<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('forget-password', [ResetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ResetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ResetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('account', AccountController::class);
	Route::resource('company', CompanyProfileController::class);
});
