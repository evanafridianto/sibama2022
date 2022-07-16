<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Drainase2022Controller;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', [AuthenticatedSessionController::class, 'create']);


Route::group(['middleware' => ['auth']], function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // drainase2022
    Route::controller(Drainase2022Controller::class)->group(function () {
        Route::get('datamaster/drainase2022', 'index')->name('drainase2022.index');
        Route::get('datamaster/drainase2022/create', 'create')->name('drainase2022.create');
        // Route::get('datamaster/penduduk/edit/{id}', 'edit')->name('penduduk.edit');
        // Route::post('datamaster/penduduk/simpan', 'store');
        Route::delete('datamaster/drainase2022/destroy/{id}', 'destroy');
        // Route::get('datamaster/penduduk/show/{nik}', 'show')->name('penduduk.show');
        // Route::get('datamaster/penduduk/export/{format}', 'export')->name('penduduk.export');
    });

    // genangan
    Route::controller(GenanganController::class)->group(function () {
        Route::get('datamaster/genangan', 'index')->name('genangan.index');

        // Route::get('datamaster/drainase2022/create', 'create')->name('drainase2022.create');

        // Route::get('datamaster/penduduk/edit/{id}', 'edit')->name('penduduk.edit');
        // Route::post('datamaster/penduduk/simpan', 'store');

        // Route::delete('datamaster/drainase2022/destroy/{id}', 'destroy');

        // Route::get('datamaster/penduduk/show/{nik}', 'show')->name('penduduk.show');
        // Route::get('datamaster/penduduk/export/{format}', 'export')->name('penduduk.export');
    });

    // user
    Route::controller(UserController::class)->group(function () {
        Route::get('profil/edit/{username}', 'edit')->name('profile.edit');
        Route::post('profil/store', 'store');
    });
});


require __DIR__ . '/auth.php';