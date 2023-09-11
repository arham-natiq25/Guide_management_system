<?php

use App\Http\Controllers\Backend\GuideListingController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// Guide controllers
Route::middleware(['auth','web','admin'])->group(function () {
Route::put('/{id}',[GuideListingController::class,'update']);
Route::delete('/{id}',[GuideListingController::class,'destroy'])->name('destroyIT');
Route::get('/{id}/edit',[GuideListingController::class,'edit']);
Route::resource('/',GuideListingController::class);
});

// I think  it exxpect model binding with resrouce  will not work with Id only
// okay
// let me scheck something

// laravel out of the boxx features like resoruce exxpect some convernstions
// routes prefix should be guides => plural
// model name shouldbe Guide   => singular
// table name should be guides = plural
// can you recreate these like this ?
// and try again
// otherwise yo have to manuallly create routs etc


