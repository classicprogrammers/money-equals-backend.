<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DropdownController;
use App\Models\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function () {
 

    Route::post('/logout', [RegistrationController::class, 'logout']);

});
///////////////Admin Middleware ///////////////////
Route::group(['middleware' => 'auth:sanctum'], function () {
    
Route::middleware('admin')->group(function () {
    // Define admin routes here
    Route::get('/getAllClients', [AdminController::class, 'index']);
    Route::get('/clients/{id}', [AdminController::class,'show']);
    Route::get('/client/Search', [AdminController::class, 'search']);
});
Route::middleware('client')->group(function () {
    // Define client routes here
    Route::post('/registerBusiness', [RegistrationController::class, 'registerBusiness']);  
 
  

    // routes/api.php
  

    Route::get('/paymentTypes',[DropdownController::class, 'payment_types']);
    Route::get('/categories',[DropdownController::class, 'categories']);
    Route::get('/subCategories',[DropdownController::class, 'subCategories']);
    Route::get('/subCategories/{category_id}', [DropdownController::class, 'BasedSubCategories']);
    Route::get('/paymentPurposes',[DropdownController::class, 'paymentPurposes']);
    Route::get('/currencies' ,[DropdownController::class, 'currencies']);
    Route::get('/paymentPerMonths',[DropdownController::class, 'index']);
    // routes/api.php
    Route::get('/paymentSchedules',[DropdownController::class, 'PaymentSchedule']);

    Route::get('/fundSources', [DropdownController::class, 'fundSources']);

    Route::get('/priceRanges', [DropdownController::class, 'priceRanges']);
    Route::get('/countries', [DropdownController::class, 'countries']);

    Route::get('/mediums', [DropdownController::class, 'mediums']);

    //////////beneficiary ///////////////
    Route::get('/getAllPhoneCode', [DropdownController::class, 'getAllPhoneCode']);
    Route::post('/addBeneficiaryIndividual', [ClientController::class, 'addBeneficiaryIndividual']);
    Route::post('/addBeneficiaryBusiness', [ClientController::class, 'addBeneficiaryBusiness']);
    Route::get('/allBeneficiaries', [ClientController::class, 'index']);
    Route::put('/beneficiaries/{id}', [ClientController::class, 'update']);
    Route::delete('/deleteBeneficiaries/{id}', [ClientController::class, 'destroy']);

    ///////////////////

});
});





Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
