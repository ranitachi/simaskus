<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/logout','UsersController@performLogout');
Route::get('/logout','UsersController@logout');

Route::get('/login/{jenis}', 'Auth\LoginController@index');
Route::get('/beranda', 'DashboardController@index')->name('beranda');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('program-studi/{dept_id}', 'ProgamStudiController@by_dept');

//Mahasiswa Admin
Route::resource('mahasiswa-admin','Admin\MahasiswaAdminController')->middleware('auth');
Route::get('mahasiswa-admin-data', 'Admin\MahasiswaAdminController@data')->middleware('auth');
Route::get('mahasiswa-admin-hapus/{id}', 'Admin\MahasiswaAdminController@destroy')->middleware('auth');

//dosen Admin
Route::resource('dosen-admin','Admin\DosenAdminController')->middleware('auth');
Route::get('dosen-admin-data', 'Admin\DosenAdminController@data')->middleware('auth');
Route::get('dosen-admin-hapus/{id}', 'Admin\DosenAdminController@destroy')->middleware('auth');

//staf Admin
Route::resource('staf-admin','Admin\StafAdminController')->middleware('auth');
Route::get('staf-admin-data', 'Admin\StafAdminController@data')->middleware('auth');
Route::get('staf-admin-hapus/{id}', 'Admin\StafAdminController@destroy')->middleware('auth');

//departemen Admin
Route::resource('departemen-admin','Admin\DepartemenAdminController')->middleware('auth');
Route::get('departemen-admin-data', 'Admin\DepartemenAdminController@data')->middleware('auth');
Route::get('departemen-admin-hapus/{id}', 'Admin\DepartemenAdminController@destroy')->middleware('auth');

//programstudi Admin
Route::resource('programstudi-admin','Admin\ProgamstudiAdminController')->middleware('auth');
Route::get('programstudi-admin-data', 'Admin\ProgamstudiAdminController@data')->middleware('auth');
Route::get('programstudi-admin-hapus/{id}', 'Admin\ProgamstudiAdminController@destroy')->middleware('auth');

//jenispengajuan Admin
Route::resource('master-jenispengajuan','Admin\MasterJenisPengajuanController')->middleware('auth');
Route::get('master-jenispengajuan-data', 'Admin\MasterJenisPengajuanController@data')->middleware('auth');
Route::get('master-jenispengajuan-hapus/{id}', 'Admin\MasterJenisPengajuanController@destroy')->middleware('auth');

//Syaratpengajuan Admin
Route::resource('master-syaratpengajuan','Admin\SyaratPengajuanController')->middleware('auth');
Route::get('master-syaratpengajuan-data', 'Admin\SyaratPengajuanController@data')->middleware('auth');
Route::get('master-syaratpengajuan-hapus/{id}', 'Admin\SyaratPengajuanController@destroy')->middleware('auth');

//Master Ruangan Admin
Route::resource('master-ruangan','Admin\MasterRuanganController')->middleware('auth');
Route::get('master-ruangan-data', 'Admin\MasterRuanganController@data')->middleware('auth');
Route::get('master-ruangan-hapus/{id}', 'Admin\MasterRuanganController@destroy')->middleware('auth');
//---------------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------------
// Mahasiswa
Route::get('mahasiswa-by-npm/{npm}', 'MahasiswaController@get_by_npm');
Route::get('profil', 'MahasiswaController@profil')->middleware('auth');
Route::get('cekpassmhs/{pass}', 'MahasiswaController@cekpass')->middleware('auth');
Route::post('/registrasi-mhs', 'MahasiswaController@registrasi');
Route::post('/simpan_password_mhs', 'MahasiswaController@simpanpassword')->name('simpan.password')->middleware('auth');
Route::post('/simpan-college-mhs', 'MahasiswaController@simpancollege')->name('simpan.college')->middleware('auth');
Route::post('/simpan-profil-mhs', 'MahasiswaController@simpanprofil')->name('simpan.profil')->middleware('auth');

Route::resource('skripsi-pengajuan','Mahasiswa\PengajuanSkripsiController');
Route::get('skripsi-pengajuan-data', 'Mahasiswa\PengajuanSkripsiController@data')->middleware('auth');