<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\StatsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public registration routes
Route::post('valuers/register',[RegistrationController::class,'registerValuer']);
Route::post('clients/register',[RegistrationController::class,'registerClient']);
Route::post('fi/register',[RegistrationController::class,'registerFinancialInstitution']);

Route::post('generate-otp',[RegistrationController::class,'generate_otp']);

//Authentication Routes
@require_once('Api/auth.php');

 //valuers routes
 require_once('Api/valuers.php');

 require_once('Api/payments.php');

 require_once('Api/trend.php');

 require_once('Api/fis.php');

 require_once('Api/posts.php');

Route::middleware(['auth:sanctum'])->group(function () {



    //users routes
    require_once('Api/users.php');

     //users routes
     require_once('Api/clients.php');

     //
     Route::get('stats',[StatsController::class,'admin_index']);

});
