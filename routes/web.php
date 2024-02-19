<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index']);
Route::post('/spoiler/create', [HomeController::class, 'storeSpoiler'])->name('create.spoiler');
Route::post('/phone-number/create', [HomeController::class, 'storePhoneNumber'])->name('create.phone.number');