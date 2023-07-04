<?php
   use App\Http\Controllers\Api\ValuersController;
   use App\Http\Controllers\Api\ValidatorController;
   use App\Http\Controllers\Api\ValuationController;



   Route::middleware(['auth:sanctum'])->group(function () {


   });

   Route::apiResource('valuers',ValuersController::class);

   //registration validators
   Route::post('registration-validator',[ValidatorController::class,'validate_valuer_registration']);
 

   Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('valuation', ValuationController::class);
        Route::post('valuation/search', [ValuationController::class,'search']);
        Route::post('valuation/{id}/images/', [ValuationController::class, 'uploadImages']);
   });


?>
