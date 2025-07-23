<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Routing\Route as RoutingRoute;
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



// Admin login 

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login')->defaults('guard', 'admin');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit')->defaults('guard', 'admin');
});

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});


// Freelancer login 

Route::prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login')->defaults('guard', 'freelancer');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit')->defaults('guard', 'freelancer');
});

Route::prefix('freelancer')->middleware('auth:freelancer')->name('freelancer.')->group(function () {
    Route::get('dashboard', function () {
        return view('freelancer.dashboard');
    })->name('dashboard');
});


// Web user login

Route::get('login', [LoginController::class, 'index'])->name('web.login')->defaults('guard', 'web');
Route::post('login', [LoginController::class, 'login'])->name('web.login.submit')->defaults('guard', 'web');

Route::get('dashboard', function () {
    return "Hiiii";
})->middleware('auth:web')->name('web.dashboard');