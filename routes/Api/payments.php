<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\SubscriptionController;


Route::middleware(['auth'])->group(function () {
    Route::apiResource('payments', PaymentController::class);
    Route::post('payments/{id}/images', [PaymentController::class, 'paymentAttachment']);

    Route::apiResource('subscriptions', SubscriptionController::class);
});
