<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoonController;
use App\Http\Controllers\User\SignUpController;
use App\Http\Controllers\User\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SilkPaymentController;
use App\Http\Controllers\User\SignInController;

Route::get('/',  [HomeController::class, 'index']);
Route::get('/home',  [HomeController::class, 'index'])->name('home');
Route::get('/books',  [HomeController::class, 'books']);
Route::get('/videos',  [HomeController::class, 'videos']);
Route::get('/privacy',  [HomeController::class, 'privacy']);
Route::get('/cookie',  [HomeController::class, 'cookie']);
Route::get('/terms',  [HomeController::class, 'terms']);

Route::get('/profile', [HomeController::class, 'profile'])->middleware('authUser');
Route::get('/packages', [HomeController::class, 'packages'])->middleware('authUser');
Route::get('/access', [HomeController::class, 'access'])->middleware('authUser');

Route::post('/create-pay-link', [NoonController::class, 'createInvoice']);
Route::post('/payment-callback', [SilkPaymentController::class, 'paymentCallback'])->name('payment.callback');

Route::get('/success_silk', [SilkPaymentController::class, 'success_silk']);
Route::get('/cancel_silk',  [SilkPaymentController::class, 'cancel_silk']);
Route::get('/notify_silk',  [SilkPaymentController::class, 'notify_silk']);
Route::get('/network_success',  [NoonController::class, 'network_success']);
Route::post('/webhook/network', [NoonController::class, 'networkWebhook']);

Route::get('/network_cancel',  [NoonController::class, 'network_cancel']);
Route::post('sign-in', SignInController::class)->name('sign-in');
Route::post('sign-up', SignUpController::class)->name('sign-up');
Route::post('password-reset', [HomeController::class,'Passwordreset'])->name('password-reset');
Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class);
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
