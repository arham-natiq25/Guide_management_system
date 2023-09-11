<?php

use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\AgencyController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\GuideListingController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\RiverController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TripController;
use App\Http\Controllers\Customers\CustomerLoginController;
use App\Http\Controllers\Frontend\BasicsController;
use App\Http\Controllers\Guides\GuideLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reservation\ReservationController as ReservationReservationController;
use Illuminate\Support\Facades\Route;

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



// Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin controller
Route::get('/admin/login',[AdminLoginController::class,'index'])->name('admin.login');
Route::get('/admin/register',[AdminLoginController::class,'register'])->name('admin.register');
Route::get('/admin/forget',[AdminLoginController::class,'forget_password'])->name('admin.forget');

// admin dashboard

Route::middleware(['auth','web','admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminLoginController::class,'dashboard'])->name('admin.dashboard');
    // trip routes
Route::delete('/trips/{}',[TripController::class,'deleteTrip'])->name('trips.deleteTrip');
Route::resource('/trips',TripController::class);
// river routes
Route::resource('rivers',RiverController::class);
// agency routes
Route::resource('agencies', AgencyController::class);
// location routes
Route::resource('locations', LocationController::class);
// coupons route
Route::resource('coupons', CouponController::class);
// Reservation / Resevation routes
Route::get('reservations',[ReservationReservationController::class,'index'])->name('reservations.home');
Route::get('reservations/showTrips',[ReservationReservationController::class,'showTrip'])->name('reservations.showTrip');
Route::get('/reservations/{id}/select-date', [ReservationReservationController::class, 'showSelectDate'])->name('reservations.select-date');
Route::get('/reservations/{id}/reserve', [ReservationReservationController::class, 'showReservationForm'])->name('reservations.reserve');
Route::post('/reservtions/save',[ReservationReservationController::class,'save'])->name('reservations.save');
Route::get('/reservation/{id}/edit',[ReservationReservationController::class,'edit'])->name('reservations.edit');
Route::put('reservation/{id}/update',[ReservationReservationController::class,'update'])->name('reservations.update');
Route::delete('reservation/{id}/delete',[ReservationReservationController::class,'delete'])->name('reservations.delete');
// Calender Controller
Route::get('/calendars',[CalendarController::class,'index'])->name('calendar.index');
// SETTING CONTROLLER
Route::resource('/settings',SettingController::class);
});
// GUIDE LOGIN ROUTESS
Route::middleware(['auth','web','guide'])->group(function(){
    Route::get('/guide/dashboard',[GuideLoginController::class,'index'])->name('guide.dashboard');
    Route::get('/guide/reservations',[GuideLoginController::class,'reservations'])->name('guide.reservations');
});

//CUSTOMER LOGIN ROUTES
Route::middleware(['auth','web','customer'])->group(function () {
    Route::get('/customer/dashboard',[CustomerLoginController::class,'index'])->name('customer.dashboard');
    Route::get('/customer/reservation',[CustomerLoginController::class,'reservation'])->name('customer.reservations');
});

Route::get('/',[BasicsController::class ,'index'])->name('gms.home');
Route::get('/{id}/selecttrip',[BasicsController::class ,'selectDate'])->name('gms.selectDate');
Route::get('/{id}/customer-details',[BasicsController::class,'customer'])->name('gms.customer');
Route::post('/customer/save',[BasicsController::class,'savedata'])->name('gms.save');


require __DIR__.'/auth.php';
