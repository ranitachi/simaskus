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
use Intervention\Image\ImageManagerStatic as Image;

Route::get('/', function () {
    $bln=date('n');
    $thn=date('Y');
    if($bln<=12 && $bln>=7)
    {
        $ta=date('Y').' / '.(date('Y')+1);
        $jenis='Gasal';
    }
    else
    {
        $ta=(date('Y')-1).' / '.date('Y');
        $jenis='Genap';
    }
    $cek=\App\Model\TahunAjaran::where('tahun_ajaran',$ta)->where('jenis',$jenis)->first();
    if(!$cek)
    {
        // echo $cek;
        \App\Model\TahunAjaran::create([
            'tahun_ajaran'=>$ta,
            'jenis'=>$jenis
        ]);
    }

    if(Auth::check())
        return redirect('beranda');
    else
        return view('auth.login');
});
Route::get('/getcontent','DashboardController@getcontent');

Auth::routes();
Route::post('/logout','UsersController@performLogout');
Route::get('/logout','UsersController@logout');
Route::get('/logout_akun','UsersController@logout_akun');

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
Route::get('master-jenispengajuan-data/{departemen_id?}', 'Admin\MasterJenisPengajuanController@data')->middleware('auth');
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
Route::get('mahasiswa-by-email/{email}', 'MahasiswaController@get_by_email');
Route::get('profil', 'MahasiswaController@profil')->middleware('auth');
Route::get('cekpassmhs/{pass}', 'MahasiswaController@cekpass')->middleware('auth');
Route::post('/registrasi-mhs', 'MahasiswaController@registrasi');
Route::post('/simpan_password_mhs', 'MahasiswaController@simpanpassword')->name('simpan.password')->middleware('auth');
Route::post('/simpan-college-mhs', 'MahasiswaController@simpancollege')->name('simpan.college')->middleware('auth');
Route::post('/simpan-profil-mhs', 'MahasiswaController@simpanprofil')->name('simpan.profil')->middleware('auth');

// Route::post('pengajuan-admin','Mahasiswa\PengajuanSkripsiController@store')->middleware('auth');
// Route::post('pengajuan-admin/{id}','Mahasiswa\PengajuanSkripsiController@update')->middleware('auth');
Route::resource('pengajuan','Mahasiswa\PengajuanSkripsiController')->middleware('auth');
Route::get('pengajuan-data/{id?}', 'Mahasiswa\PengajuanSkripsiController@data')->middleware('auth');
Route::get('pengajuan-hapus/{id}', 'Mahasiswa\PengajuanSkripsiController@destroy')->middleware('auth');
Route::get('pengajuan-detail/{id}','Mahasiswa\PengajuanSkripsiController@detail')->middleware('auth');
Route::get('data-bimbingan-mhs/{id?}','Mahasiswa\PengajuanSkripsiController@index_bimbingan_mhs')->middleware('auth');
//----------Pengajuan S3
Route::resource('pengajuan-disertasi','Mahasiswa\PengajuanS3Controller')->middleware('auth');
Route::resource('pengajuan-s3','Mahasiswa\PengajuanS3Controller')->middleware('auth');
Route::get('pengajuan-data-disertasi/{id?}', 'Mahasiswa\PengajuanS3Controller@data')->middleware('auth');
Route::get('pengajuan-hapus-disertasi/{id}', 'Mahasiswa\PengajuanS3Controller@destroy')->middleware('auth');
Route::get('pengajuan-detail-disertasi/{id}','Mahasiswa\PengajuanS3Controller@detail')->middleware('auth');
Route::get('data-bimbingan-disertasi-mhs/{id?}','Mahasiswa\PengajuanS3Controller@index_bimbingan_mhs')->middleware('auth');
Route::post('unggah-sk-rektor','Mahasiswa\PengajuanS3Controller@unggah_sk_rektor');

Route::get('cek-pengajuan/{id}','Mahasiswa\PengajuanS3Controller@cek_pengajuan');
///-----------------------

Route::get('data-pengajuan','Admin\PengajuanController@pengajuan')->middleware('auth');
Route::get('data-bimbingan','Admin\PengajuanController@data_bimbingan')->middleware('auth');
Route::get('data-pengajuan-detail/{id}','Admin\PengajuanController@detail')->middleware('auth');
Route::get('pengajuan-verifikasi/{id}/{jenis}','Admin\PengajuanController@verifikasi')->middleware('auth');
Route::get('pengajuan-verifikasi-semua','Admin\PengajuanController@verifikasi_semua')->middleware('auth');
Route::get('pengajuan-tolak/{id}/{jenis}','Admin\PengajuanController@tolak')->middleware('auth');
Route::get('pengajuan-hapus/{id}/{jenis}','Admin\PengajuanController@destroy')->middleware('auth');
Route::get('verifikasi-pengajuan/{id}','Admin\PengajuanController@verifikasi_pengajuan')->middleware('auth');
Route::get('setujui-pengajuan-bimbingan/{pengajuan_id}/{mahasiswa_id}/{dosen_id}','Admin\PengajuanController@setujui_pengajuan_bimbingan')->middleware('auth');
Route::get('setujui-pengajuan-bimbingan-semua/{pengajuan_id}','Admin\PengajuanController@setujui_pengajuan_bimbingan_semua')->middleware('auth');
Route::get('hapus-pengajuan-bimbingan/{pengajuan_id}/{mahasiswa_id}/{dosen_id}','Admin\PengajuanController@hapus_pengajuan_bimbingan')->middleware('auth');
Route::get('generate-pembimbing/{dept_id}','Admin\PengajuanController@generate_pembimbing')->middleware('auth');

Route::resource('daftar-sidang','Mahasiswa\DaftarSidangController')->middleware('auth');
Route::get('daftar-sidang-data','Mahasiswa\DaftarSidangController@data')->middleware('auth');

//---------------------------------------------------------------------------------------------------------------------------------------
//-----------BIMBINGAN--------------
Route::resource('bimbingan','BimbinganController')->middleware('auth');
Route::get('bimbingan/{idbimbingan?}/{idpengajuan?}','BimbinganController@show')->middleware('auth');
Route::get('bimbingan-data/{idmhs?}/{idpengajuan?}','BimbinganController@data')->middleware('auth');
Route::get('bimbingan-data-hapus/{id}/{idmhs?}/{idpengajuan?}','BimbinganController@destroy')->middleware('auth');

//-----------JADWAL FRONT--------------
Route::get('jadwal/{jenis}','JadwalController@index');
Route::get('jadwal-sidang','JadwalController@sidang')->middleware('auth');
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
Route::get('data-pengajuan-sidang-data/{jenis}/{old?}','JadwalController@pengajuan_sidang_staf_data')->middleware('auth');
Route::get('pengajuan-sidang-verifikasi/{id}/{jenis}','JadwalController@pengajuan_sidang_verifikasi')->middleware('auth');
Route::get('setujui-acc-manager/{idpengajuan}/{idmahasiswa}','JadwalController@setuju_acc_manager')->middleware('auth');

//Generate Jadwal
Route::post('generate-jadwal/{dept_id}','JadwalController@generate')->middleware('auth');
Route::post('atur-jadwal/{dept_id}','JadwalController@atur_jadwal')->middleware('auth');
Route::get('berkas-sidang/{jenis}/{jadwal_id}/{pengajuan_id}','JadwalController@berkas_sidang')->middleware('auth');
//---------Notifikasi---------
Route::resource('notifikasi', 'NotifikasiController')->middleware('auth');
Route::get('notifikasi-data', 'NotifikasiController@data')->middleware('auth');
Route::get('notifikasi-baca/{id}/{st}', 'NotifikasiController@baca')->middleware('auth');

//Master Pimpinan Departemen
Route::resource('pimpinan-departemen','MasterPimpinanController')->middleware('auth');
Route::get('pimpinan-departemen-data', 'MasterPimpinanController@data')->middleware('auth');
Route::get('pimpinan-departemen-hapus/{id}', 'MasterPimpinanController@destroy')->middleware('auth');

//Quota Bimbingn
Route::resource('quota-bimbingan','QuotaBimbinganController')->middleware('auth');
Route::get('quota-bimbingan-data','QuotaBimbinganController@data')->middleware('auth');
Route::get('quota-bimbingan-hapus/{id}','QuotaBimbinganController@destroy')->middleware('auth');

//Quota Penguji
Route::resource('quota-penguji','QuotaPengujiController')->middleware('auth');
Route::get('quota-penguji-data','QuotaPengujiController@data')->middleware('auth');
Route::get('quota-penguji-hapus/{id}','QuotaPengujiController@destroy')->middleware('auth');

//Minimal Bimbingan
Route::resource('minimal-bimbingan','QuotaJumlahBimbinganController')->middleware('auth');
Route::get('minimal-bimbingan-data','QuotaJumlahBimbinganController@data')->middleware('auth');
Route::get('minimal-bimbingan-hapus/{id}','QuotaJumlahBimbinganController@destroy')->middleware('auth');

//Quota pembimbing
Route::resource('quota-pembimbing','QuotaPembimbingController')->middleware('auth');
Route::get('quota-pembimbing-data','QuotaPembimbingController@data')->middleware('auth');
Route::get('quota-pembimbing-hapus/{id}','QuotaPembimbingController@destroy')->middleware('auth');
Route::get('jlh_pembimbing/{idjenis}/{kat_dosen?}/{id_pengajuan?}','QuotaPembimbingController@jlh_pembimbing')->middleware('auth');
Route::get('get-pembimbing/{idjenis}/{i}/{idpm?}/{kat_dosen?}/{idpengajuan?}','QuotaPembimbingController@get_pembimbing')->middleware('auth');
Route::get('getdatapembimbing/{idjenis}/{iddosen}/{i}/{kuota}/{kat_dosen?}/{idpengajuan?}','QuotaPembimbingController@getdatapembimbing')->middleware('auth');

//DOSEN
Route::get('pengajuan-bimbingan','Dosen\PengajuanBimbinganController@pengajuan')->middleware('auth');
Route::get('daftar-bimbingan','Dosen\PengajuanBimbinganController@daftar')->middleware('auth');
Route::get('bimbingan-detail/{id}/{mahasiswa_id}','Dosen\PengajuanBimbinganController@detail')->middleware('auth');
Route::get('bimbingan-data-dosen/{id}/{idpengajuan?}','Dosen\PengajuanBimbinganController@bimbingandata')->middleware('auth');
Route::get('pengajuan-data-dosen/{jenis}','Dosen\PengajuanBimbinganController@data')->middleware('auth');
Route::get('pengajuan-bimbingan-status/{id}/{st}','Dosen\PengajuanBimbinganController@status')->middleware('auth');
Route::get('data-bimbingan-status/{id}/{st}','Dosen\PengajuanBimbinganController@data_bimbingan_status')->middleware('auth');
Route::get('data-bimbingan-setuju/{id}/{mhs_id}','Dosen\PengajuanBimbinganController@data_bimbingan_setuju')->middleware('auth');

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
// Route::post('add-penguji-staf/{idpengajuan}','DosenController@add_penguji_staf')->middleware('auth');

Route::resource('izin-dosen','IzinDosenController')->middleware('auth');
Route::get('izin-dosen-data','IzinDosenController@data')->middleware('auth');
Route::get('izin-dosen-hapus/{id}','IzinDosenController@destroy')->middleware('auth');

Route::get('update-notif/{id}','NotifikasiController@update_notif')->middleware('auth');

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
Route::get('penilaian-penguji','Dosen\PenilaianController@pengujinonkp')->middleware('auth');
Route::get('penilaian-penguji-kp','Dosen\PenilaianController@pengujikp')->middleware('auth');
Route::get('penilaian-pembimbing','Dosen\PenilaianController@penilaian_pembimbing')->middleware('auth');
Route::get('form-nilai-dosen/{idjadwal}/{idpengajuan}','Dosen\PenilaianController@form')->middleware('auth');
Route::get('daftar-perbaikan/{idjadwal}/{idpengajuan}','Dosen\PenilaianController@perbaikan')->middleware('auth');
Route::get('penetapan-judul/{idjadwal}/{idpengajuan}','Dosen\PenilaianController@penetapan')->middleware('auth');
Route::post('simpan-nilai','Dosen\PenilaianController@simpan_nilai');
Route::post('daftar-perbaikan','Dosen\PenilaianController@daftar_perbaikan');
Route::post('penetapan-judul','Dosen\PenilaianController@penetapan_judul');
//--STAF PENILAIAN
Route::resource('penilaian-staf','Admin\PenilaianControllerStaf')->middleware('auth');
Route::get('form-penilaian/{jadwal_id}/{pengajuan_id}','Admin\PenilaianControllerStaf@form_pembimbing')->middleware('auth');
Route::get('form-nilai-dosen-staf/{idjadwal}/{idpengajuan}/{iddosen}','Admin\PenilaianControllerStaf@form')->middleware('auth');
Route::get('daftar-perbaikan-staf/{idjadwal}/{idpengajuan}/{iddosen}','Admin\PenilaianControllerStaf@perbaikan')->middleware('auth');
Route::get('penetapan-judul-staf/{idjadwal}/{idpengajuan}/{iddosen}','Admin\PenilaianControllerStaf@penetapan')->middleware('auth');
Route::post('simpan-nilai-staf','Admin\PenilaianControllerStaf@simpan_nilai');
Route::post('daftar-perbaikan-staf','Admin\PenilaianControllerStaf@daftar_perbaikan');
Route::post('penetapan-judul-staf','Admin\PenilaianControllerStaf@penetapan_judul');
//----------

//Kerja Praktek//
Route::get('data-kp','KerjaPraktekController@index')->middleware('auth');
Route::get('data-kp/{id}/{kat_user}','KerjaPraktekController@form')->middleware('auth');
Route::get('data-kp-data','KerjaPraktekController@data')->middleware('auth');
Route::get('data-kp-hapus/{id}','KerjaPraktekController@destroy')->middleware('auth');
Route::get('data-kp-detail/{id}/{kat_user}','KerjaPraktekController@detail')->middleware('auth');
Route::get('data-kp-verifikasi/{id}/{status}','KerjaPraktekController@verifikasi')->middleware('auth');
Route::get('mulai-kp/{id}','KerjaPraktekController@mulai_kp')->middleware('auth');

Route::get('data-kp-grup/{idkp}/{idmhs}/{idgrup}','KerjaPraktekController@grup_kp')->middleware('auth');
Route::get('data-kp-anggota/{code_grup}/{id}','KerjaPraktekController@form_anggota')->middleware('auth');
Route::get('data-kp-hapus-anggota/{id}','KerjaPraktekController@hapus_anggota')->middleware('auth');
Route::post('data-kp-anggota-proses/{code_grup}/{id}','KerjaPraktekController@form_anggota_proses')->middleware('auth');
Route::post('data-kp-grup/{idkp}/{idmhs}/{idgrup}','KerjaPraktekController@grup_kp_simpan')->middleware('auth');
Route::get('no-grup/{idkp}/{idmhs}/{idgrup}','KerjaPraktekController@no_grup_kp')->middleware('auth');

Route::post('data-kp-proses/{id}','KerjaPraktekController@proses')->middleware('auth');
Route::post('informasi-kp-proses/{idgrup}/{id}','KerjaPraktekController@informasi_kp_proses')->middleware('auth');
Route::post('anggota-kelompok-proses/{idgrup}/{id}','KerjaPraktekController@anggota_kelompok_proses')->middleware('auth');
Route::post('pembimbing-proses/{idgrup}/{id}','KerjaPraktekController@pembimbing_proses')->middleware('auth');
Route::get('data-kp-hapus-pembimbing/{id}/{kat_user}/{idp}','KerjaPraktekController@hapus_pembimbing')->middleware('auth');

Route::get('cetak-berkas/{code_grup}/{kat_user}/{jenis}/{idmhs?}','KerjaPraktekController@cetak_berkas')->middleware('auth');
Route::post('upload-balasan-kp','KerjaPraktekController@upload_balasan_kp')->middleware('auth');
Route::post('upload-selesai-kp','KerjaPraktekController@upload_selesai_kp')->middleware('auth');
Route::get('data-kp-mulai/{code}','KerjaPraktekController@data_kp_mulai')->middleware('auth');
Route::get('data-kp-selesai/{code}','KerjaPraktekController@data_kp_selesai')->middleware('auth');
Route::get('berita-acara-kp/{id}','KerjaPraktekController@berita_acara')->middleware('auth');
Route::get('penilaian-kp/{id}','KerjaPraktekController@penilaian_kp')->middleware('auth');
Route::get('cetak-evaluasi-kp/{id}','KerjaPraktekController@cetak_evaluasi_kp')->middleware('auth');
Route::get('selesai-kp/{id}','KerjaPraktekController@selesai_kp')->middleware('auth');

// data-pengajuan-sidang-kp
//Pengajuan Sidang
Route::get('data-jadwal-kp','JadwalController@pengajuan_sidang_kp')->middleware('auth');
Route::get('data-jadwal-kp-form/{id}','JadwalController@pengajuan_sidang_kp_form')->middleware('auth');
Route::get('data-pengajuan-sidang-kp','JadwalController@pengajuan_sidang_staf_kp')->middleware('auth');
Route::get('data-pengajuan-sidang-kp-data','JadwalController@pengajuan_sidang_staf_kp_data')->middleware('auth');
Route::get('pengajuan-sidang-kp-verifikasi/{id}','JadwalController@pengajuan_sidang_verifikasi_kp')->middleware('auth');
Route::get('publish-kp/{idjadwal}','JadwalController@publish_kp')->middleware('auth');
Route::get('hapusjadwalkp/{idjadwal}','JadwalController@hapusjadwalkp')->middleware('auth');
Route::post('jadwal-sidang-kp-simpan/{all_one}/{id}/{idkp?}','JadwalController@simpan_jadwal_sidang_kp')->middleware('auth');



//Acc Sidang
Route::post('simpan-form-evaluasi-skripsi','Dosen\PengajuanBimbinganController@simpan_form_evaluasi_skipsi')->middleware('auth');
Route::post('pengajuan-penguji/{id}/{mahasiswa_id}','Dosen\PengajuanBimbinganController@simpan_data_penguji')->middleware('auth');

Route::get('hapus-data-penguji/{dosen_id}/{id}','Dosen\PengajuanBimbinganController@hapus_data_penguji')->middleware('auth');
Route::get('pengajuan-acc-dosen','Dosen\PengajuanBimbinganController@pengajuan_acc_dosen')->middleware('auth');

Route::get('add_pendidikan','HomeController@add_pendidikan')->middleware('auth');
Route::get('kolom-topik/{id}','HomeController@kolom_topik')->middleware('auth');
Route::get('acc-sidang/{idpengajuan?}/{iddosen}','Admin\PengajuanController@acc_sidang')->middleware('auth');

Route::get('rekap-penguji/{bulan?}/{tahun?}','DosenController@rekap_penguji')->middleware('auth');
Route::get('rekap-pembimbing/{tahunajaran?}','DosenController@rekap_pembimbing')->middleware('auth');
Route::get('rekap-penguji-staf/{iddosen?}/{bulan?}/{tahun?}','DosenController@rekap_penguji_staf')->middleware('auth');
Route::get('rekap-pembimbing-staf/{iddosen?}/{bulan?}/{tahun?}','DosenController@rekap_pembimbing_staf')->middleware('auth');



Route::get('showgambar/{folder}/{filename}', function ($folder,$filename)
{
    
    $file=$folder.'/'.$filename;
    //return Image::make(storage_path($file))->response();
    //return storage_path('app').'/public/'.$file;
     return response()->file(storage_path('app').'/public/'.$file);
});
Route::get('izindosen','DashboardController@updateizindosen');
Route::get('updatemulaikp','DashboardController@updatemulaikp');

Route::get('secret','HomeController@secret');
Route::get('logout_sso','HomeController@logout');


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::post('regis-dosen-staf','HomeController@regis_dosen_staf');
Route::get('refresh-csrf', function(){
    return csrf_token();
});
