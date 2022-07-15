<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Drainase2022Controller;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [AuthenticatedSessionController::class, 'create']);


Route::group(['middleware' => ['auth']], function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // drainase2022
    Route::controller(Drainase2022Controller::class)->group(function () {
        Route::get('datamaster/drainase2022', 'index')->name('drainase2022.index');
        // Route::get('datamaster/penduduk/tambah', 'create')->name('penduduk.create');
        // Route::get('datamaster/penduduk/edit/{id}', 'edit')->name('penduduk.edit');
        // Route::post('datamaster/penduduk/simpan', 'store');
        Route::delete('datamaster/drainase2022/destroy/{id}', 'destroy');
        // Route::get('datamaster/penduduk/show/{nik}', 'show')->name('penduduk.show');
        // Route::get('datamaster/penduduk/export/{format}', 'export')->name('penduduk.export');
    });
});


require __DIR__ . '/auth.php';