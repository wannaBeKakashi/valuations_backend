<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\RegistrationController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Web\ValuerController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\FinancialInstitutionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',function(){
      return redirect()->route("login");
});
Auth::routes();

Route::middleware(['auth'])->group(function(){

    //admin
    Route::get('admin/index',   [AdminController::class,'renderIndex'])->name('admin.home');
    Route::get('admin/users',   [AdminController::class,'renderUsers']);
    Route::get('admin/valuers', [AdminController::class,'renderValuers']);
    Route::get('admin/fis',     [AdminController::class,'renderFinancialInstitutions']);
    Route::get('admin/valuations',     [AdminController::class,'renderValuations']);


    //valuers
    Route::get('valuer/index', [ValuerController::class,'renderIndex'] )->name('valuer.home');
    Route::get('valuer/comps', [ValuerController::class,'renderComps'] );
    Route::get('valuer/upload', [ValuerController::class,'renderUpload']);


    //clients
    Route::get('client/index', [ClientController::class,'renderIndex'] )->name('client.home');
    Route::get('client/valuers', [ClientController::class,'renderValuers']);

    //financial institution
    Route::get('fi/index', [FinancialInstitutionController::class,'renderIndex'])->name('financial_institution.home');


});

Route::get('/user/home', [HomeController::class,'home'])->name('home');

Route::get('register',[RegistrationController::class,'rendervaluersRegistrationForm'])->name('register');

Route::get('/index', function(){
  return view('pages.index');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
