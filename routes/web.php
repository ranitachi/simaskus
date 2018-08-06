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
    return view('index');
});

Auth::routes();
Route::post('/logout','UsersController@performLogout');
Route::get('/logout','UsersController@logout');

//Route::get('/login/{jenis}', 'Auth\LoginController@index');
Route::get('/beranda', 'DashboardController@index')->name('beranda');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('program-studi/{dept_id}', 'ProgamStudiController@by_dept');

//Mahasiswa Admin
Route::resource('mahasiswa-admin','Admin\MahasiswaAdminController')->middleware('auth');
Route::get('mahasiswa-admin-data', 'Admin\MahasiswaAdminController@data')->middleware('auth');
Route::get('mahasiswa-admin-hapus/{id}', 'Admin\MahasiswaAdminController@destroy')->middleware('auth');
Route::get('mahasiswa-detail/{id}', 'Admin\MahasiswaAdminController@detail')->middleware('auth');
Route::get('verifikasi-mahasiswa/{id}', 'Admin\MahasiswaAdminController@verifikasi_mahasiswa')->middleware('auth');
Route::post('mahasiswa-verifikasi', 'Admin\MahasiswaAdminController@verifikasi')->middleware('auth');

//dosen Admin
Route::resource('dosen-admin','Admin\DosenAdminController')->middleware('auth');
Route::get('dosen-admin-data', 'Admin\DosenAdminController@data')->middleware('auth');
Route::get('dosen-admin-hapus/{id}', 'Admin\DosenAdminController@destroy')->middleware('auth');

//staf Admin
Route::resource('staf-admin','Admin\StafAdminController')->middleware('auth');
Route::get('staf-admin-data', 'Admin\StafAdminController@data')->middleware('auth');
Route::get('staf-admin-hapus/{id}', 'Admin\StafAdminController@destroy')->middleware('auth');
//user Admin
Route::resource('user-admin','Admin\UserAdminController')->middleware('auth');
Route::get('user-admin-data', 'Admin\UserAdminController@data')->middleware('auth');
Route::get('user-admin-hapus/{id}', 'Admin\UserAdminController@destroy')->middleware('auth');

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
//Master Jenjang Admin
Route::resource('jenjang','Admin\JenjangController')->middleware('auth');
Route::get('jenjang-data', 'Admin\JenjangController@data')->middleware('auth');
Route::get('jenjang-hapus/{id}', 'Admin\JenjangController@destroy')->middleware('auth');
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

Route::resource('pengajuan','Mahasiswa\PengajuanSkripsiController')->middleware('auth');
// Route::post('pengajuan-admin','Mahasiswa\PengajuanSkripsiController@store')->middleware('auth');
// Route::post('pengajuan-admin/{id}','Mahasiswa\PengajuanSkripsiController@update')->middleware('auth');
Route::get('pengajuan-data', 'Mahasiswa\PengajuanSkripsiController@data')->middleware('auth');
Route::get('pengajuan-hapus/{id}', 'Mahasiswa\PengajuanSkripsiController@destroy')->middleware('auth');
Route::get('pengajuan-detail/{id}','Mahasiswa\PengajuanSkripsiController@detail')->middleware('auth');
Route::get('data-pengajuan','Admin\PengajuanController@pengajuan')->middleware('auth');
Route::get('data-pengajuan-detail/{id}','Admin\PengajuanController@detail')->middleware('auth');
Route::get('pengajuan-verifikasi/{id}/{jenis}','Admin\PengajuanController@verifikasi')->middleware('auth');
Route::get('pengajuan-tolak/{id}/{jenis}','Admin\PengajuanController@tolak')->middleware('auth');
Route::get('pengajuan-hapus/{id}/{jenis}','Admin\PengajuanController@destroy')->middleware('auth');

Route::resource('daftar-sidang','Mahasiswa\DaftarSidangController')->middleware('auth');
Route::get('daftar-sidang-data','Mahasiswa\DaftarSidangController@data')->middleware('auth');

//---------------------------------------------------------------------------------------------------------------------------------------
//-----------BIMBINGAN--------------
Route::resource('bimbingan','BimbinganController')->middleware('auth');
Route::get('bimbingan-data','BimbinganController@data')->middleware('auth');

//-----------JADWAL FRONT--------------
Route::get('jadwal/{jenis}','JadwalController@index');
Route::get('jadwal-sidang','JadwalController@sidang');
Route::get('jadwal-sidang-data/{jenis}','JadwalController@pengajuan_sidang_mhs_data');

//Staff------------
Route::get('profil-staf', 'StafController@profil')->middleware('auth');
Route::post('/simpan_password_staf', 'StafController@simpanpassword')->name('simpan.passwordstaf')->middleware('auth');
Route::post('/simpan-profil-staf', 'StafController@simpanprofil')->name('simpan.profil')->middleware('auth');
//Staff------------
Route::get('profil-dosen', 'DosenController@profil')->middleware('auth');
Route::post('/simpan_password_dosen', 'DosenController@simpanpassword')->name('simpan.passworddosen')->middleware('auth');
Route::post('/simpan-profil-dosen', 'DosenController@simpanprofil')->name('simpan.profil')->middleware('auth');

//Pengajuan Sidang
Route::get('data-jadwal/{jenis}','JadwalController@pengajuan_sidang_staf')->middleware('auth');
Route::get('data-pengajuan-sidang/{jenis}','JadwalController@pengajuan_sidang_staf')->middleware('auth');
Route::get('data-pengajuan-sidang-data/{jenis}','JadwalController@pengajuan_sidang_staf_data')->middleware('auth');
Route::get('pengajuan-sidang-verifikasi/{id}/{jenis}','JadwalController@pengajuan_sidang_verifikasi')->middleware('auth');

//Generate Jadwal
Route::post('generate-jadwal/{dept_id}','JadwalController@generate')->middleware('auth');

//---------Notifikasi---------
Route::resource('notifikasi', 'NotifikasiController')->middleware('auth');
Route::get('notifikasi-data', 'NotifikasiController@data')->middleware('auth');
Route::get('notifikasi-baca/{id}/{st}', 'NotifikasiController@baca')->middleware('auth');

//Master Pimpinan Departemen
Route::resource('pimpinan-departemen','MasterPimpinanController')->middleware('auth');
Route::get('pimpinan-departemen-data', 'MasterPimpinanController@data')->middleware('auth');
Route::get('pimpinan-departemen-hapus/{id}', 'MasterPimpinanController@destroy')->middleware('auth');

//DOSEN
Route::get('pengajuan-bimbingan','Dosen\PengajuanBimbinganController@pengajuan')->middleware('auth');
Route::get('daftar-bimbingan','Dosen\PengajuanBimbinganController@daftar')->middleware('auth');
Route::get('bimbingan-detail/{id}/{mahasiswa_id}','Dosen\PengajuanBimbinganController@detail')->middleware('auth');
Route::get('bimbingan-data-dosen/{id}','Dosen\PengajuanBimbinganController@bimbingandata')->middleware('auth');
Route::get('pengajuan-data/{jenis}','Dosen\PengajuanBimbinganController@data')->middleware('auth');
Route::get('pengajuan-bimbingan-status/{id}/{st}','Dosen\PengajuanBimbinganController@status')->middleware('auth');
Route::get('data-bimbingan-status/{id}/{st}','Dosen\PengajuanBimbinganController@data_bimbingan_status')->middleware('auth');

Route::get('pengajuan-sidang','Dosen\PengajuanSidangController@index')->middleware('auth');
Route::get('pengajuan-sidang-data','Dosen\PengajuanSidangController@data')->middleware('auth');
Route::get('pengajuan-sidang-status/{id_pengajuan}/{id_mahasiswa}','Dosen\PengajuanSidangController@setujui')->middleware('auth');
Route::get('jadwal-sidang-dosen','Dosen\PengajuanSidangController@indexjadwal')->middleware('auth');
Route::get('jadwal-sidang-dosen-data','Dosen\PengajuanSidangController@jadwal_sidang_dosen_data');
Route::get('form-nilai/{idjadwal}/{idpengajuan}','Dosen\PengajuanSidangController@form_nilai');

Route::get('unduh-file/{dir}/{file}','HomeController@unduhfile')->middleware('auth');
Route::get('dokumen-verifikasi/{id}/{jns}','JadwalController@dokumen_verifikasi')->middleware('auth');

Route::get('form-add-penguji','DosenController@formadd_penguji')->middleware('auth');
Route::post('add-penguji/{idpengajuan}','DosenController@add_penguji')->middleware('auth');

//---------kalender-akademik---------
Route::resource('kalender-akademik', 'Admin\KalenderAkademikController')->middleware('auth');
Route::get('kalender-akademik/{idta}/{id}', 'Admin\KalenderAkademikController@show')->middleware('auth');
Route::post('kalender-akademik/{idta}/{id}', 'Admin\KalenderAkademikController@proses')->middleware('auth');
Route::get('kalender-akademik-data/{ta}', 'Admin\KalenderAkademikController@data')->middleware('auth');
Route::get('kalender-akademik-hapus/{id}', 'Admin\KalenderAkademikController@destroy')->middleware('auth');

//---------kategori penilaian----------
Route::resource('kategori-penilaian', 'Admin\ModuleController')->middleware('auth');
Route::get('kategori-penilaian-data', 'Admin\ModuleController@data')->middleware('auth');
Route::get('kategori-penilaian-hapus/{id}', 'Admin\ModuleController@destroy')->middleware('auth');
//---------komponen penilaian----------
Route::resource('komponen-penilaian', 'Admin\ComponentController')->middleware('auth');
Route::get('komponen-penilaian-data/{id}', 'Admin\ComponentController@data')->middleware('auth');
Route::get('komponen-penilaian-hapus/{id}', 'Admin\ComponentController@destroy')->middleware('auth');
//---------subkomponen----------
Route::resource('subkomponen', 'Admin\SubComponentController')->middleware('auth');
Route::get('subkomponen-data/{id}', 'Admin\SubComponentController@data')->middleware('auth');
Route::get('subkomponen-hapus/{id}', 'Admin\SubComponentController@destroy')->middleware('auth');

Route::get('datadosen', 'HomeController@datadosen');
Route::get('dataruangan', 'HomeController@dataruangan');

Route::resource('penilaian','Dosen\PenilaianController')->middleware('auth');
Route::get('form-nilai-dosen/{idjadwal}/{idpengajuan}','Dosen\PenilaianController@form')->middleware('auth');
Route::get('daftar-perbaikan/{idjadwal}/{idpengajuan}','Dosen\PenilaianController@perbaikan')->middleware('auth');
Route::get('penetapan-judul/{idjadwal}/{idpengajuan}','Dosen\PenilaianController@penetapan')->middleware('auth');