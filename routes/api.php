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

Route::get('password', function(){
    return bcrypt('MangWidy');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::get('/siswa', 'API\SiswaController@index');
Route::get('/siswa/{siswa}', 'API\SiswaController@show');
Route::delete('/siswa/{siswa}', 'API\SiswaController@destroy');
Route::post('/siswa/', 'API\SiswaController@store');
Route::patch('/siswa/{siswa}', 'API\SiswaController@update');


Route::get('/waliguru', 'API\WaliguruController@index');
Route::get('/waliguru/{waliguru}', 'API\WaliguruController@show');
Route::delete('/waliguru/{waliguru}', 'API\WaliguruController@destroy');
Route::post('/waliguru/', 'API\WaliguruController@store');
Route::patch('/waliguru/{waliguru}', 'API\WaliguruController@update');


Route::get('/kelas', 'API\KelasController@index');
Route::get('/kelas/{kelas}', 'API\KelasController@show');
Route::delete('/kelas/{kelas}', 'API\KelasController@destroy');
Route::post('/kelas/', 'API\KelasController@store');
Route::patch('/kelas/{kelas}', 'API\KelasController@update');


Route::get('/sekolah', 'API\SekolahController@index');
Route::get('/sekolah/{sekolah}', 'API\SekolahController@show');
Route::delete('/sekolah/{sekolah}', 'API\SekolahController@destroy');
Route::post('/sekolah/', 'API\SekolahController@store');
Route::patch('/sekolah/{sekolah}', 'API\SekolahController@update');