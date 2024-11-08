<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\FlatbedController;

Route::get('/', function () {
    return view('login');
});

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('dashboard', DashboardController::class);

    Route::group(['middleware' => ['can:viewUsers']], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::resource('users', UserController::class);
        Route::post('/users/{user}/updateRole', [UserController::class, 'updateRole'])->name('users.updateRole');
        Route::put('/users/{user}/updatePassword', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    });

    Route::group(['middleware' => ['can:viewTrucks']], function () {
        Route::get('/trucks', [TruckController::class, 'index'])->name('trucks.index');
        Route::resource('trucks', TruckController::class);
    });

    Route::group(['middleware' => ['can:viewFlatbeds']], function () {
        Route::get('/flatbeds', [FlatbedController::class, 'index'])->name('flatbeds.index');
        Route::resource('flatbeds', FlatbedController::class);
    });
});
