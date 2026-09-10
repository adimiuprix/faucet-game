<?php

use App\Http\Controllers\AdvertiseController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\FaucetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MegaRewardController;
use App\Http\Controllers\MiningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\SurfAdController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::post('/auth/process', [HomeController::class, 'auth_process'])->name('auth.process');

// Protected routes - butuh login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'profileUpdate'])->name('profile.update');

    Route::get('/mega-reward', [MegaRewardController::class, 'index'])->name('mega-reward');

    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit');

    Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw');

    Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals');

    Route::get('/coupond', [CouponController::class, 'index'])->name('coupon');
    Route::post('/coupon/redeem', [CouponController::class, 'redeem'])->name('coupon.redeem');

    Route::get('/faucet/{coin}', [FaucetController::class, 'index'])->name('faucet');
    Route::post('/faucet/verify', [FaucetController::class, 'verify'])->name('faucet.verify');

    Route::get('/surf-ad/{coin}', [SurfAdController::class, 'index'])->name('ptc');
    Route::get('/surf-ad/{coin}/start/{id}', [SurfAdController::class, 'start'])->name('ptc.start');
    Route::post('/surf-ad/{coin}/verify/{id}', [SurfAdController::class, 'verify'])->name('ptc.verify');

    Route::get('/mining', [MiningController::class, 'index'])->name('mining');
    Route::post('/mining/buy', [MiningController::class, 'buy'])->name('mining.buy');
    Route::post('/mining/claim/{mining_id}', [MiningController::class, 'claim'])->name('mining.claim');
    Route::post('/mining/sync', [MiningController::class, 'sync'])->name('mining.sync');

    Route::get('/advertise', [AdvertiseController::class, 'index'])->name('ads');
    Route::get('/advertise/manage', [AdvertiseController::class, 'manage'])->name('ads.manage');
});

// Admin routes
require __DIR__.'/admin.php';
