<?php

use App\Http\Controllers\Api\PostsController;


Route::middleware(['auth:sanctum'])->group(function () {

    Route::apiResource('posts',PostsController::class);
         
});

?>