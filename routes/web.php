<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;
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

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('login', [AuthController::class, 'indexLogin'])->name('indexLogin')->defaults('guard', 'admin');
//     Route::post('login', [AuthController::class, 'login'])->name('login.submit')->defaults('guard', 'admin');

//     Route::get('forgot-password', [ResetPasswordController::class, 'forgotIndex'])->name('password.request')->defaults('guard', 'admin');
//     Route::post('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email')->defaults('guard', 'admin');

//     Route::get('reset-password/{token}', [NewPasswordController::class, 'ResetIndex'])->name('password.reset')->defaults('guard', 'admin');
//     Route::post('reset-password', [NewPasswordController::class, 'resetPassword'])->name('password.update')->defaults('guard', 'admin');

    

// });

Route::prefix('admin')->middleware('auth:admin' )->name('admin.')->group(function () {
    // Route::get('dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('dashboard');
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->defaults('guard', 'admin');

    Route::resource('roles', RoleController::class);

    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::get('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('/projects/{project}/forcedelete', [ProjectController::class, 'forcedelete'])->name('projects.forcedelete');
    Route::resource('projects', ProjectController::class);
  
});


// Freelancer  

// Route::prefix('freelancer')->name('freelancer.')->group(function () {
//     Route::get('login', [AuthController::class, 'indexLogin'])->name('indexLogin')->defaults('guard', 'freelancer');
//     Route::post('login', [AuthController::class, 'login'])->name('login.submit')->defaults('guard', 'freelancer');
    
//     Route::get('register', [AuthController::class, 'indexRegister'])->name('register')->defaults('guard', 'freelancer');
//     Route::post('register', [AuthController::class,  'register'])->name('register.submit')->defaults('guard', 'freelancer');

//     Route::get('forgot-password', [ResetPasswordController::class, 'forgotIndex'])->name('password.request')->defaults('guard', 'freelancer');
//     Route::post('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email')->defaults('guard', 'freelancer');

//     Route::get('reset-password/{token}', [NewPasswordController::class, 'ResetIndex'])->name('password.reset')->defaults('guard', 'freelancer');
//     Route::post('reset-password', [NewPasswordController::class, 'resetPassword'])->name('password.update')->defaults('guard', 'freelancer');

// });

// Route::prefix('freelancer')->middleware('auth:freelancer', 'verified')->name('freelancer.')->group(function () {
   
//     Route::get('dashboard', function () {
//         return view('freelancer.dashboard');
//     })->name('dashboard');
// });


// Web user 

// Route::prefix('web')->name('web.')->group(
//     function () {
// Route::get('login', [AuthController::class, 'indexLogin'])->name('indexLogin')->defaults('guard', 'web');

// Route::post('login', [AuthController::class, 'login'])->name('login.submit')->defaults('guard', 'web');
// Route::get('register', [AuthController::class, 'indexRegister'])->name('register')->defaults('guard', 'web');
// Route::post('register', [AuthController::class, 'register'])->name('register.submit')->defaults('guard', 'web');
// Route::get('dashboard', function () {
//     return "Hiiii";
// })->middleware('auth:web', 'verified')->name('dashboard');


//     Route::get('forgot-password', [ResetPasswordController::class, 'forgotIndex'])->name('password.request')->defaults('guard', 'web');
//     Route::post('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email')->defaults('guard', 'web');

//     Route::get('reset-password/{token}', [NewPasswordController::class, 'ResetIndex'])->name('password.reset')->defaults('guard', 'web');
//     Route::post('reset-password', [NewPasswordController::class, 'resetPassword'])->name('password.update')->defaults('guard', 'web');
//     }
// );
// Route::get('verify-email/{guard}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', 'web|freelancer');






//macro routes 
// Route::authGuard('web', 'web', 'web');
// Route::authGuard('freelancer', 'freelancer', 'freelancer');
// Route::authGuard('admin', 'admin', 'admin',['register'=>false ]);


Route::get('/{guard}/verify-email', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', expression: 'web|freelancer');


Route::get('confirm', function () {
    return redirect()->route('verification.verify');
})->name('con');


