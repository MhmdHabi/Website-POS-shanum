<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProdukController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/produk', [ProdukController::class, 'index'])->name('dashboard.produk');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::post('/produk/delete/{id}', [ProdukController::class, 'delete'])->name('produk.delete');
Route::get('/laporan', [LaporanController::class, 'index'])->name('dashboard.laporan');
Route::get('/penjualan', [LaporanController::class, 'penjualan'])->name('penjualan.index');
Route::post('/penjualan', [LaporanController::class, 'store'])->name('penjualan.store');
Route::get('/export_penjualan', [LaporanController::class, 'exportPenjualan'])->name('export.penjualan');
Route::get('/penjualan/pdf', [LaporanController::class, 'exportPDF'])->name('penjualan.pdf');
