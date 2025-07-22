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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('login', function () {
//     return view('pages.login');
// });

Route::prefix('admin/')->middleware('auth_admin')->name('admin.')->group(function(){
Route::get('login',[LoginController::class,'index'])->name('login')->defaults('guard','admin');
Route::post('login',[LoginController::class,'login'])->name('login.submit')->defaults('guard','admin');

Route::get('dashboard', function(){
    return view('admin.dashboard');
})->name('dashboard');
});

Route::prefix('freelancer/')->middleware('auth_freelancer')->name('freelancer.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login')->defaults('guard', 'freelancer');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit')->defaults('guard', 'freelancer');

    Route::get('dashboard', function () {
        return view('freelancer.dashboard');
    })->name('dashboard');
});

Route::get('login', [LoginController::class, 'index'])->name('web.login')->defaults('guard', 'web');
Route::post('login', [LoginController::class, 'login'])->name('web.login.submit')->defaults('guard', 'web');

Route::get('dashboard', function () {
    return "Hiiii";
})->middleware('auth_user')->name('web.dashboard');