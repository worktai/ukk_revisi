<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PesananController;

Route::get('/', function () {
    return view('/welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// ADMIN ( ROUTE DATA USER CRU (MELIHAT, EDIT) )
Route::get('pengguna/index', 'PenggunaController@index')->name('index')->middleware('cekstatus:admin');
Route::post('/pengguna/create', 'PenggunaController@create')->name('pengguna.create')->middleware('cekstatus:admin');
Route::get('pengguna/{id}/edit', 'PenggunaController@edit')->name('pengguna.edit')->middleware('cekstatus:admin');


// HALAMAN ADMIN
Route::get('/utama', function() {
    return view('admin.utama', ["title" => "Log Aktivitas Pegawai"]);
})->name('utama')->middleware('cekstatus:admin');


// HALAMAN KASIR
Route::get('/catatan_transaksi', function(){
    return view ('kasir.catatan_transaksi' ,["title" => "Catatan Transaksi"]);
})->name('catatan_transaksi')->middleware('cekstatus:kasir');

// KASIR -> FOLDER PELANGGAN -> HALAMAN ORDER DAN TRANSAKSI:
Route::get('/pesan',[KasirController::class , 'index'])->name('indexpesan');
Route::get('/list',[KasirController::class , 'showlist']);
Route::post('/pesan/tambah_pesan',[KasirController::class , 'order']);
Route::get('/pesan/{id}', [KasirController::class, 'tambahpesan']);
Route::get('/cetak/{id}', [KasirController::class, 'cetakpesan']);



// HALAMAN MANEJER
Route::get('/note', function() {
    return view('manejer.note', ["title" => "Log Aktivitas Pegawai"]);
})->name('note')->middleware('cekstatus:manejer');

// MANEJER -> HALAMAN DATA KATAGORI. CONTOHNYA MAKANAN/MINUMAN
route::resource('kategori','KategoriController');

// MANEJER -> HALAMAN DATA MENU. CONTOHNYA NASI PADANG
route::resource('menu','MenuController');

// MANEJER -> HALAMAN DATA MEJA
route::resource('meja','MejaController');
