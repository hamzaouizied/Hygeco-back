<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ContactCommercialController;


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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    Route::get('/contacts', [ContactFormController::class, 'index'])->middleware('auth:api')->name('contacts');
    Route::get('/contacts-commercial', [ContactCommercialController::class, 'index'])->middleware('auth:api')->name('contactCommercial');
    Route::get('/notifications/contact-created', [ContactFormController::class, 'getContactCreatedNotifications'])->middleware('auth:api')->name('contactCreatedNotifications');
});
Route::post('/submit-form', [ContactFormController::class, 'submitForm']);
Route::post('/submit-forms', [ContactCommercialController::class, 'submitForm']);

