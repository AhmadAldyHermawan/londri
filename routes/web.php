<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\outletController;
use App\Http\Controllers\paketController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\detailController;
use App\Http\Controllers\dashboardController;



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


//login
Route::get('/',[authController::class,'halamanlogin'])->name('halaman-login');
Route::post('/',[authController::class,'login'])->name('login');

// Route::group(['middleware' => 'prevent-back-history'],function(){
 Route::group(['middleware' => ['auth']],function(){

 
// dashboard
Route::get('/dashboard',[dashboardController::class,'dashboard'])->name('dashboard');

//edit pengurus
Route::get('/data-user/edit/{id}',[authController::class,'edit'])->name('edit-user');
Route::put('/data-user/update/{id}',[authController::class,'update'])->name('update-user');

//detail transaksi
Route::get('/transaksi',[transaksiController::class,'tampil'])->name('tampil-transaksi');
Route::get('/detail-transaksi/{id}',[transaksiController::class,'detailTransaksi'])->name('tampil-detail');

//generate laporan
Route::get('/laporan/{id}',[detailController::class,'laporan'])->name('laporan');

//hak akses admin
Route::middleware(['auth','RoleMiddleware:admin'])->group (function() {
    
//pengurus
Route::get('/data-user',[authController::class,'tampil'])->name('tampil-user');
Route::get('/data-user/tambah',[authController::class,'tambah'])->name('tambah-user');
Route::post('/data-user/simpan',[authController::class,'simpan'])->name('simpan-user');
Route::delete('/data-user/hapus/{id}',[authController::class,'hapus'])->name('hapus-user');
Route::get('/data-user/cari',[authController::class,'cari'])->name('cari-user');

//outlet
Route::get('/outlet',[outletController::class,'tampil'])->name('tampil-outlet');
Route::get('/outlet/tambah',[outletController::class,'tambah'])->name('tambah-outlet');
Route::post('/outlet/simpan',[outletController::class,'simpan'])->name('simpan-outlet');
Route::get('/outlet/edit/{id}',[outletController::class,'edit'])->name('edit-outlet');
Route::put('/outlet/edit/{id}',[outletController::class,'update'])->name('update-outlet');
Route::delete('/outlet/hapus/{id}',[outletController::class,'hapus'])->name('hapus-outlet');
Route::get('/outlet/cari',[outletController::class,'cari'])->name('cari-outlet');

//paket
Route::get('/paket',[paketController::class,'tampil'])->name('tampil-paket');
Route::get('/paket/tambah',[paketController::class,'tambah'])->name('tambah-paket');
Route::post('/paket/simpan',[paketController::class,'simpan'])->name('simpan-paket');
Route::get('/paket/edit/{id}',[paketController::class,'edit'])->name('edit-paket');
Route::put('/paket/edit/{id}',[paketController::class,'update'])->name('update-paket');
Route::delete('/paket/hapus/{id}',[paketController::class,'hapus'])->name('hapus-paket');
Route::get('/paket/cari',[paketController::class,'cari'])->name('cari-paket');

});
//hak akses admin dan kasir
Route::middleware(['auth','RoleMiddleware:admin,kasir'])->group (function() {


//member
Route::get('/member',[memberController::class,'tampil'])->name('tampil-member');
Route::get('/member/tambah',[memberController::class,'tambah'])->name('tambah-member');
Route::post('/member/simpan',[memberController::class,'simpan'])->name('simpan-member');
Route::get('/member/edit/{id}',[memberController::class,'edit'])->name('edit-member');
Route::put('/member/edit/{id}',[memberController::class,'update'])->name('update-member');
Route::delete('/member/hapus/{id}',[memberController::class,'hapus'])->name('hapus-member');
Route::get('/member/cari',[memberController::class,'cari'])->name('cari-member');

//transaksi
Route::get('/transaksi/tambah',[transaksiController::class,'tambah'])->name('tambah-transaksi');
Route::post('/transaksi/simpan',[transaksiController::class,'simpan'])->name('simpan-transaksi');
Route::get('/transaksi/edit/{id}',[transaksiController::class,'edit'])->name('edit-transaksi');
Route::put('/transaksi/edit/{id}',[transaksiController::class,'update'])->name('update-transaksi');
Route::delete('/transaksi/hapus/{id}',[transaksiController::class,'hapus'])->name('hapus-transaksi');
Route::get('/transaksi/cari',[transaksiController::class,'cari'])->name('cari-transaksi');

// Route::get('/detail-transaksi/tambah',[detailController::class,'tambah'])->name('tambah-detail');

});
//logout
Route::get('/logout',[authController::class,'logout'])->name('logout');

});
// });