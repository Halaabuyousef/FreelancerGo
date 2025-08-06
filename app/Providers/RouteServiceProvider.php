<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\Cast\String_;
use App\Http\Controllers\RoleController;
use Illuminate\Cache\RateLimiting\Limit;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\NewPasswordController;
// use Laravel\Fortify\Http\Controllers\NewPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });


        Route::macro('authGuard', function (string $prefix, string $name, string $guard, array $options = []) {

            Route::prefix($prefix)->name($name . '.')->group(function () use ($guard, $options) {
                Route::middleware('guest:' . $guard)->group(function () use ($guard, $options) {
                    Route::get('login', [AuthController::class, 'indexLogin'])->name('indexLogin')->defaults('guard', $guard);
                    Route::post('login', [AuthController::class, 'login'])->name('login.submit')->defaults('guard', $guard);

                    if (!isset($options['register']) || $options['register'] !== false) {
                        Route::get('register', [AuthController::class, 'indexRegister'])->name('register')->defaults('guard', $guard);
                        Route::post('register', [AuthController::class,  'register'])->name('register.submit')->defaults('guard', $guard);
                    }

                    Route::get('forgot-password', [ResetPasswordController::class, 'forgotIndex'])->name('password.request')->defaults('guard', $guard);
                    Route::post('forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.email')->defaults('guard', $guard);

                    Route::get('reset-password/{token}', [NewPasswordController::class, 'resetIndex'])->name('password.reset')->defaults('guard', $guard);
                    Route::post('reset-password', [NewPasswordController::class, 'resetPassword'])->name('password.update')->defaults('guard', $guard);
                    
                   
                });

                
               
            });
        });
    }
}
