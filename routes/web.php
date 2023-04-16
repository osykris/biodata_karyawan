<?php

use App\Models\Departemen;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Route;
use voku\helper\ASCII;
use App\Http\Controllers\ImportExportController;

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

Route::get('/', function () {
    $departemen = Departemen::all();
    $karyawan = Karyawan::join('departemens', 'karyawans.departemen_id', '=', 'departemens.id')
    ->orderBy('karyawans.tanggal_masuk', 'ASC')
    ->select('karyawans.id', 'karyawans.nama', 'karyawans.kota_penempatan', 'departemens.nama_dept', 'karyawans.departemen_id', 'karyawans.tanggal_masuk', 'karyawans.tanggal_lahir')
    ->get();
    return view('welcome', compact('departemen', 'karyawan'));
});

// departemen
Route::post('/add-departemen/save', 'App\Http\Controllers\DepartemenController@store');
Route::get('/edit-departemen', 'App\Http\Controllers\DepartemenController@edit');
Route::get('/show-departemen', 'App\Http\Controllers\DepartemenController@show');
Route::post('/update-departemen', 'App\Http\Controllers\DepartemenController@update');
Route::get('/hapus-departemen', 'App\Http\Controllers\DepartemenController@delete');
Route::post('/destroy-departemen', 'App\Http\Controllers\DepartemenController@destroy');

// karyawan
Route::post('/add-karyawan/save', 'App\Http\Controllers\KaryawanController@store');
Route::get('/edit-karyawan', 'App\Http\Controllers\KaryawanController@edit');
Route::get('/show-karyawan', 'App\Http\Controllers\KaryawanController@show');
Route::post('/update-karyawan', 'App\Http\Controllers\KaryawanController@update');
Route::get('/hapus-karyawan', 'App\Http\Controllers\KaryawanController@delete');
Route::post('/destroy-karyawan', 'App\Http\Controllers\KaryawanController@destroy');
Route::get('/detail/{id}', 'App\Http\Controllers\KaryawanController@detail')->name('detailKaryawan');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(ImportExportController::class)->group(function(){
    Route::get('export', 'export')->name('export');
});
