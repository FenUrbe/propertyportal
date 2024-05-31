<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\UpgradePlanController;
use App\Http\Controllers\UserPlanController;
use App\Http\Controllers\PayPalController;


Route::get('/', [HomeController::class, 'home'])->name('welcome');

Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/register', [RegisterController::class, 'registerUser'])->name('user.register');

Route::post('/register', [RegisterController::class, 'saveInfo'])->name('user.saveInfo');

Route::get('/verify/{id}/{hash}', [RegisterController::class, 'verifyEmail'])->name('email.verify');

Route::get('/login', [LoginController::class, 'loginUser'])->name('user.login');

Route::post('/login', [LoginController::class, 'checkInfo'])->name('user.checkInfo');

Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('user.forgotPassword');

Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordResetLink'])->name('user.sendResetLink');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');

Route::get('auth/google/call-back', [GoogleController::class, 'callbackGoogle']);

Route::get('auth/facebook', [FacebookController::class, 'redirect'])->name('facebook.login');

Route::get('auth/facebook/call-back', [FacebookController::class, 'callbackFacebook']);

Route::get('/upgradeplan', [UpgradePlanController::class, 'userPlan'])->name('user.plan')->middleware('check.seller');

Route::post('/paypal/create', [PaypalController::class, 'create'])->name('paypal.create');

Route::get('/paypal/execute', [PayPalController::class, 'execute'])->name('paypal.execute');

Route::get('/payment/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

Route::get('/user-plans/create', [UserPlanController::class, 'create'])->name('user-plans.create');

Route::post('/user-plans', [UserPlanController::class, 'store'])->name('user-plans.store');


