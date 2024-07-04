<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Home Page
Route::get('/', function () {
    return view('welcome');
});

//contact
Route::get('/pages/contact', function () {
    return view('contact');
});
//about
Route::get('/pages/about', function () {
    return view('a-propos');
});
//contact-commercial
Route::get('/pages/contact-commercial', function () {
    return view('contact-commercial');
});
//plan
Route::get('/pages/plan', function () {
    return view('plan');
});
//service
Route::get('/pages/services', function () {
    return view('service');
});

Route::controller(AuthenController::class)->group(function () {
    Route::get('/registration', 'registration')->name('register')->middleware('alreadyLoggedIn');
    Route::post('/registration-user', 'registerUser')->name('register.perform');
    Route::get('/login', 'login')->name('login')->middleware('alreadyLoggedIn');
    Route::post('/login-user', 'loginUser')->name('login.perform');
    Route::get('/dashboard', 'dashboard')->name('dashoard')->middleware('isLoggedIn');
    Route::get('/profile', 'profile')->name('profile')->middleware('isLoggedIn');

Route::post('/logout', 'logout')->name('logout');
});

Route::post('/profile/update', 'App\Http\Controllers\AuthenController@postProfile')->name('postProfile');
Route::get('/passsword/change', 'App\Http\Controllers\AuthenController@getPassword')->name('getPassword');
Route::post('/passsword/change', 'App\Http\Controllers\AuthenController@postPassword')->name('postPassword');


