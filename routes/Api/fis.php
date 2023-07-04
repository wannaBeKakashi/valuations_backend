<?php

use App\Http\Controllers\Api\FinancialInstitutionController;


Route::middleware(['auth:sanctum'])->group(function () {

    Route::apiResource('financial-institutions',FinancialInstitutionController::class);
         
});

?>