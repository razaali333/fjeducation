<?php

use App\Http\Controllers\Content\IndexContentController;
use App\Http\Controllers\Payments\CallbackController;
use App\Http\Controllers\Payments\CheckController;
use App\Http\Controllers\Payments\CreateController;
use App\Http\Controllers\Rate\IndexRateController;
use App\Http\Controllers\User\GetProfileController;
use App\Http\Controllers\User\PatchProfileController;
use App\Http\Controllers\User\ProfileContentController;
use App\Http\Controllers\User\ResetPasswordConfirmController;
use App\Http\Controllers\User\ResetPasswordRequestController;
use App\Http\Controllers\User\SignInController;
use App\Http\Controllers\User\SignUpController;
use App\Http\Controllers\User\VerifyEmailController;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Auth
    // Route::post('sign-up', SignUpController::class)->name('sign-up');
    // Route::post('sign-in', SignInController::class)->name('sign-in');
    // Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class);
    // Route::post('password-reset-request', ResetPasswordRequestController::class);
    // Route::post('password-reset-confirm', ResetPasswordConfirmController::class);
    // Route::get('profile', GetProfileController::class)->middleware(Authenticate::class);
    // Route::patch('profile', PatchProfileController::class)->middleware(Authenticate::class);

    // Rates
    // Route::get('rates', IndexRateController::class);

    // Contents
    // Route::get('contents/{type?}', IndexContentController::class);
    // Route::get('profile-contents', ProfileContentController::class)->middleware(Authenticate::class);

    // Payments
    // Route::prefix('payments')->group(function () {
    //     Route::post('create', CreateController::class)->middleware(Authenticate::class);

    //     Route::post('callback', CallbackController::class)->name('payments.callback');
    //     Route::post('check', CheckController::class)->name('payments.check');
    // });

//    Route::get('transactions', UserTransactionController::class);
//    Route::post('transactions/deposit', DepositController::class);
//    Route::post('transactions/withdraw', WithdrawController::class);
//    Route::post('transactions/withdraw-confirm', AdminWithdrawConfirmController::class);
//
//    Route::post('payment-process', ProcessController::class);
//    Route::post('payment-success', SuccessController::class);
//    Route::post('payment-fail', FailedController::class);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
