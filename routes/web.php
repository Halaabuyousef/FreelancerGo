<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;

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




// Admin 

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'indexLogin'])->name('indexLogin')->defaults('guard', 'admin');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit')->defaults('guard', 'admin');

    Route::get('forgot-password', [ResetPasswordController::class, 'forgotIndex'])->name('password.request')->defaults('guard', 'admin');
    Route::post('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email')->defaults('guard', 'admin');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'ResetIndex'])->name('password.reset')->defaults('guard', 'admin');
    Route::post('reset-password', [NewPasswordController::class, 'resetPassword'])->name('password.update')->defaults('guard', 'admin');

});

Route::prefix('admin')->middleware('auth:admin' ,'verified')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
  
});


// Freelancer  

Route::prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('login', [AuthController::class, 'indexLogin'])->name('indexLogin')->defaults('guard', 'freelancer');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit')->defaults('guard', 'freelancer');
    
    Route::get('register', [AuthController::class, 'indexRegister'])->name('register')->defaults('guard', 'freelancer');
    Route::post('register', [AuthController::class,  'register'])->name('register.submit')->defaults('guard', 'freelancer');

    Route::get('forgot-password', [ResetPasswordController::class, 'forgotIndex'])->name('password.request')->defaults('guard', 'freelancer');
    Route::post('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email')->defaults('guard', 'freelancer');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'ResetIndex'])->name('password.reset')->defaults('guard', 'freelancer');
    Route::post('reset-password', [NewPasswordController::class, 'resetPassword'])->name('password.update')->defaults('guard', 'freelancer');

});

Route::prefix('freelancer')->middleware('auth:freelancer', 'verified')->name('freelancer.')->group(function () {
   
    Route::get('dashboard', function () {
        return view('freelancer.dashboard');
    })->name('dashboard');
});


// Web user 

Route::prefix('web')->name('web.')->group(
    function () {
Route::get('login', [AuthController::class, 'indexLogin'])->name('indexLogin')->defaults('guard', 'web');

Route::post('login', [AuthController::class, 'login'])->name('login.submit')->defaults('guard', 'web');
Route::get('register', [AuthController::class, 'indexRegister'])->name('register')->defaults('guard', 'web');
Route::post('register', [AuthController::class, 'register'])->name('register.submit')->defaults('guard', 'web');
Route::get('dashboard', function () {
    return "Hiiii";
})->middleware('auth:web', 'verified')->name('dashboard');


    Route::get('forgot-password', [ResetPasswordController::class, 'forgotIndex'])->name('password.request')->defaults('guard', 'web');
    Route::post('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email')->defaults('guard', 'web');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'ResetIndex'])->name('password.reset')->defaults('guard', 'web');
    Route::post('reset-password', [NewPasswordController::class, 'resetPassword'])->name('password.update')->defaults('guard', 'web');
    }
);
Route::get('verify-email/{guard}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', 'web|freelancer');


