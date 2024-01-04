<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('home/tampil', 'HomeController@tampil');
	Route::resource('pelanggan', 'ControllerPelanggan');
	Route::resource('pemasok', 'ControllerPemasok');
	Route::resource('unit', 'ControllerUnit');
	Route::resource('produk', 'ControllerProduk');
	Route::resource('pembelian', 'ControllerPembelian');
	Route::get('penjualan', 'ControllerPenjualan@index');
	Route::get('penjualan/get-pelanggan', 'ControllerPenjualan@get_pelanggan');
	Route::get('penjualan/produk', 'ControllerPenjualan@produk');
	Route::get('penjualan/tampil-keranjang', 'ControllerPenjualan@keranjang_produk');
	Route::post('penjualan/keranjang/{id}', 'ControllerPenjualan@keranjang');
	Route::get('penjualan/get-keranjang/{id}', 'ControllerPenjualan@get_keranjang');
	Route::post('penjualan/edit-keranjang', 'ControllerPenjualan@edit_keranjang');
	Route::delete('penjualan/hapus/{id}', 'ControllerPenjualan@hapus');
	Route::post('penjualan/proses', 'ControllerPenjualan@proses');
	Route::post('penjualan/reset', 'ControllerPenjualan@reset');
	Route::get('penjualan/laporan', 'ControllerPenjualan@laporan');
	Route::get('penjualan/get-laporan/{id}', 'ControllerPenjualan@get_laporan');
	Route::post('penjualan/detail/{id}', 'ControllerPenjualan@detail');
	Route::get('penjualan/cetak/{id}', 'ControllerPenjualan@cetak');
	Route::get('user', 'ControllerUser@index');
	Route::get('user/profil', 'ControllerUser@profil');
	Route::post('user/simpan-profil', 'ControllerUser@simpan_profil');
	Route::get('user/password', 'ControllerUser@password');
	Route::post('user/simpan-password', 'ControllerUser@simpan_password');
});
