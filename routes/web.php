<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/','RegController@view');
Route::get('backend','RegController@index');
Route::get('delete','RegController@deleteUser');
Route::get('edit','RegController@editUser');
// ===================================================
Route::get('/image','ImageController@index');
Route::post('image-backend','ImageController@addImage')->name('image-backend');
Route::get('delete/{id}','ImageController@deleteAvatar');
Route::get('download/{file}','ImageController@downloadAvatar');
