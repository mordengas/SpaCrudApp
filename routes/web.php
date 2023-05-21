<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class,'index']);

Route::get('/users', [UserController::class, 'indexUser'])->name('users');

Route::get('/treatments',[TreatmentController::class,'index'])->name('treatments');

Route::get('/clients',[ClientController::class,'index'])->name('clients');

Route::get('/reservations',[ReservationController::class,'index'])->name('reservations');

Route::get('/bookings',[HomeController::class,'indexBookings'])->name('bookings');

Route::get('/addbookings',[BookingsController::class,'addBooking'])->name('addbookings');

Route::get('booking/add/{id}', [BookingsController::class,'index']);

Route::resource('home',HomeController::class);

Route::resource('clientsCRUD',ClientController::class);
Route::resource('treatmentsCRUD',TreatmentController::class);
Route::resource('reservations',ReservationController::class);



Route::get('/login',[LoginController::class,'index']);
Route::post('/login/checklogin',[LoginController::class,'checklogin']);
Route::get('login/logout',[LoginController::class,'logout']);




