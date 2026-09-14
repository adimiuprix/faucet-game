<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCaptchaController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminCurrencyController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFaucetController;
use App\Http\Controllers\Admin\AdminMiningController;
use App\Http\Controllers\Admin\AdminPtcController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('admin.admin_prefix'))->name('admin.')->group(function () {
    Route::get('/', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/auth', [AdminAuthController::class, 'authenticate'])->name('auth');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::prefix('coupon')->name('coupon.')->group(function () {
            Route::get('/', [AdminCouponController::class, 'index'])->name('index');
            Route::get('/create', [AdminCouponController::class, 'create'])->name('create');
            Route::post('/', [AdminCouponController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AdminCouponController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminCouponController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminCouponController::class, 'destroy'])->name('destroy');
        });

        Route::get('/faucet', [AdminFaucetController::class, 'index'])->name('faucet');
        Route::get('/mining', [AdminMiningController::class, 'index'])->name('mining');

        Route::prefix('ptc')->name('ptc.')->group(function () {
            Route::get('/', [AdminPtcController::class, 'index'])->name('index');
            Route::get('/create', [AdminPtcController::class, 'create'])->name('create');
            Route::post('/', [AdminPtcController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AdminPtcController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminPtcController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminPtcController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('currency')->name('currency.')->group(function () {
            Route::get('/', [AdminCurrencyController::class, 'index'])->name('index');
            Route::post('/{id}/toggle', [AdminCurrencyController::class, 'toggleStatus'])->name('toggle');
            Route::put('/{id}/update-reward', [AdminCurrencyController::class, 'updateReward'])->name('update-reward');
        });

        Route::get('/setting', [AdminSettingController::class, 'index'])->name('setting');
        Route::put('/setting', [AdminSettingController::class, 'update'])->name('setting.update');

        Route::prefix('captcha')->name('captcha.')->group(function () {
            Route::get('/', [AdminCaptchaController::class, 'index'])->name('index');
            Route::post('/', [AdminCaptchaController::class, 'store'])->name('store');
        });

        Route::get('/user', [AdminUserController::class, 'index'])->name('user');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
