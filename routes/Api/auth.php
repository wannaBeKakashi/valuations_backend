<?php

use App\Http\Controllers\Api\AuthController;



//public routes
Route::post('login',[AuthController::class,'login']);



?>