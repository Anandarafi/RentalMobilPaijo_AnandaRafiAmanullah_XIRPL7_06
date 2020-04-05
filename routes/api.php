<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|-----------------------------------------------------------------------|
|                         LOGIN PETUGAS RENTAL                          |
|-----------------------------------------------------------------------|
*/
Route::post('login','UserController@login');
Route::get('/login/check', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                         CRUD PETUGAS RENTAL                           |
|-----------------------------------------------------------------------|
*/
Route::post('petugas','UserController@store');
Route::put('petugas/{id}','UserController@update');
Route::delete('petugas/{id}','UserController@delete');
Route::get('petugas','UserController@tampil');

/*
|-----------------------------------------------------------------------|
|                          CRUD JENIS MOBIL                             |
|-----------------------------------------------------------------------|
*/
Route::post('jenis','JenisController@store')->middleware('jwt.verify');
Route::put('jenis/{id}','JenisController@update')->middleware('jwt.verify');
Route::delete('jenis/{id}','JenisController@delete')->middleware('jwt.verify');
Route::get('jenis','JenisController@tampil')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                           CRUD PELANGGAN                              |
|-----------------------------------------------------------------------|
*/
Route::post('pelanggan','PelangganController@store')->middleware('jwt.verify');
Route::put('pelanggan/{id}','PelangganController@update')->middleware('jwt.verify');
Route::delete('pelanggan/{id}','PelangganController@delete')->middleware('jwt.verify');
Route::get('pelanggan','PelangganController@tampil')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                          CRUD PEMINJAMAN                              |
|-----------------------------------------------------------------------|
*/
Route::post('peminjaman','PeminjamanController@store')->middleware('jwt.verify');
Route::put('peminjaman/{id}','PeminjamanController@update')->middleware('jwt.verify');
Route::delete('peminjaman/{id}','PeminjamanController@delete')->middleware('jwt.verify');
Route::get('peminjaman','PeminjamanController@tampil')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                          CRUD DETAIL TRANSAKSI                        |
|-----------------------------------------------------------------------|
*/
Route::post('detail','PeminjamanController@store1');
Route::put('detail/{id}','PeminjamanController@update1')->middleware('jwt.verify');
Route::delete('detail/{id}','PeminjamanController@delete1')->middleware('jwt.verify');
Route::get('detail','PeminjamanController@tampil1')->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                            CRUD MOBIL                                 |
|-----------------------------------------------------------------------|
*/
Route::post('mobil','MobilController@store')->middleware('jwt.verify');
Route::put('mobil/{id}','MobilController@update')->middleware('jwt.verify');
Route::delete('mobil/{id}','MobilController@delete')->middleware('jwt.verify');
Route::get('mobil','MobilController@tampil')->middleware('jwt.verify');