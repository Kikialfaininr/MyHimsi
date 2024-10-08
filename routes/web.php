<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Mail;

// Halaman umum yang bisa diakses oleh semua role atau tanpa login
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/poster', [App\Http\Controllers\PosterController::class, 'index']);
Route::get('/poster/{id}', [App\Http\Controllers\PosterController::class, 'show']);
Route::get('/prestasi', [App\Http\Controllers\PrestasiController::class, 'index']);
Route::get('/divisi/{id}', [App\Http\Controllers\DivisiController::class, 'index']);
Route::get('/berita/{id}', [App\Http\Controllers\BeritaController::class, 'show']);
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index']);
Route::get('/arsip', [App\Http\Controllers\ArsipController::class, 'index']);
Route::get('/event', [App\Http\Controllers\EventController::class, 'index']);
Route::get('/event/{category?}', [App\Http\Controllers\EventController::class, 'index']);
Route::get('/sertifikat', [App\Http\Controllers\SertifikatController::class, 'index']);

Auth::routes();

Route::get('/forbidden', function () {
    return view('forbidden');
})->name('forbidden');


// Halaman untuk admin dan pengurus
Route::group(['middleware' => ['auth', RoleMiddleware::class.':Admin,Pengurus']], function () {
    // Dashboard admin
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // halaman admin users
    Route::get('/admin-users', [App\Http\Controllers\AdminUsersController::class, 'index']);
    Route::post('/simpan-data-users', [App\Http\Controllers\AdminUsersController::class, 'simpan']);
    Route::get('{id}/edit-users', [App\Http\Controllers\AdminUsersController::class, 'edit']);
    Route::post('/update-users/{id}', [App\Http\Controllers\AdminUsersController::class, 'update']);
    Route::get('{id}/hapus-users', [App\Http\Controllers\AdminUsersController::class, 'hapus']);
    Route::get('/downloadpdf-users', [App\Http\Controllers\AdminUsersController::class, 'downloadpdf']);
    Route::get('/downloadpdf-users-angkatan', [App\Http\Controllers\AdminUsersController::class, 'downloadpdfByAngkatan']);

    // halaman admin periode
    Route::get('/admin-periode', [App\Http\Controllers\AdminPeriodeController::class, 'index']);
    Route::post('/simpan-data-periode', [App\Http\Controllers\AdminPeriodeController::class, 'simpan']);
    Route::get('{id}/edit-periode', [App\Http\Controllers\AdminPeriodeController::class, 'edit']);
    Route::post('/update-periode/{id}', [App\Http\Controllers\AdminPeriodeController::class, 'update']);
    Route::get('{id}/hapus-periode', [App\Http\Controllers\AdminPeriodeController::class, 'hapus']);

    // halaman admin divisi
    Route::get('/admin-divisi', [App\Http\Controllers\AdminDivisiController::class, 'index']);
    Route::post('/simpan-data-divisi', [App\Http\Controllers\AdminDivisiController::class, 'simpan']);
    Route::get('{id}/edit-divisi', [App\Http\Controllers\AdminDivisiController::class, 'edit']);
    Route::post('/update-divisi/{id}', [App\Http\Controllers\AdminDivisiController::class, 'update']);
    Route::get('{id}/hapus-divisi', [App\Http\Controllers\AdminDivisiController::class, 'hapus']);
    Route::get('/downloadpdf-divisi', [App\Http\Controllers\AdminDivisiController::class, 'downloadpdf']);
    Route::get('/downloadpdf-divisi-periode', [App\Http\Controllers\AdminDivisiController::class, 'downloadpdfByPeriode']);

    // halaman admin jabatan
    Route::get('/admin-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'index']);
    Route::post('/simpan-data-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'simpan']);
    Route::get('{id}/edit-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'edit']);
    Route::post('/update-jabatan/{id}', [App\Http\Controllers\AdminJabatanController::class, 'update']);
    Route::get('{id}/hapus-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'hapus']);
    Route::get('/downloadpdf-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'downloadpdf']);
    Route::get('/downloadpdf-jabatan-periode', [App\Http\Controllers\AdminJabatanController::class, 'downloadpdfByPeriode']);

    // halaman admin angggota
    Route::get('/admin-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'index']);
    Route::post('/simpan-data-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'simpan']);
    Route::get('{id}/edit-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'edit']);
    Route::post('/update-anggota/{id}', [App\Http\Controllers\AdminAnggotaController::class, 'update']);
    Route::get('{id}/hapus-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'hapus']);
    Route::get('/downloadpdf-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'downloadpdf']);
    Route::get('/downloadpdf-anggota-periode', [App\Http\Controllers\AdminAnggotaController::class, 'downloadpdfByPeriode']);

    // halaman admin proker
    Route::get('/admin-proker', [App\Http\Controllers\AdminProkerController::class, 'index']);
    Route::post('/simpan-data-proker', [App\Http\Controllers\AdminProkerController::class, 'simpan']);
    Route::get('{id}/edit-proker', [App\Http\Controllers\AdminProkerController::class, 'edit']);
    Route::post('/update-proker/{id}', [App\Http\Controllers\AdminProkerController::class, 'update']);
    Route::get('{id}/hapus-proker', [App\Http\Controllers\AdminProkerController::class, 'hapus']);
    Route::get('/downloadpdf-proker', [App\Http\Controllers\AdminProkerController::class, 'downloadpdf']);
    Route::get('/downloadpdf-proker-periode', [App\Http\Controllers\AdminProkerController::class, 'downloadpdfByPeriode']);

    // halaman admin artikel
    Route::get('/admin-artikel', [App\Http\Controllers\AdminArtikelController::class, 'index']);
    Route::post('/simpan-data-artikel', [App\Http\Controllers\AdminArtikelController::class, 'simpan']);
    Route::get('{id}/edit-artikel', [App\Http\Controllers\AdminArtikelController::class, 'edit']);
    Route::post('/update-artikel/{id}', [App\Http\Controllers\AdminArtikelController::class, 'update']);
    Route::post('/status-artikel/{id}', [App\Http\Controllers\AdminArtikelController::class, 'status']);
    Route::get('{id}/hapus-artikel', [App\Http\Controllers\AdminArtikelController::class, 'hapus']);
    Route::get('/downloadpdf-artikel', [App\Http\Controllers\AdminArtikelController::class, 'downloadpdf']);

    // halaman admin haki
    Route::get('/admin-haki', [App\Http\Controllers\AdminHakiController::class, 'index']);
    Route::post('/simpan-data-haki', [App\Http\Controllers\AdminHakiController::class, 'simpan']);
    Route::get('{id}/edit-haki', [App\Http\Controllers\AdminHakiController::class, 'edit']);
    Route::post('/update-haki/{id}', [App\Http\Controllers\AdminHakiController::class, 'update']);
    Route::post('/status-haki/{id}', [App\Http\Controllers\AdminHakiController::class, 'status']);
    Route::get('{id}/hapus-haki', [App\Http\Controllers\AdminHakiController::class, 'hapus']);
    Route::get('/downloadpdf-haki', [App\Http\Controllers\AdminHakiController::class, 'downloadpdf']);

    // halaman admin tugas akhir
    Route::get('/admin-tugasakhir', [App\Http\Controllers\AdminTugasAkhirController::class, 'index']);
    Route::post('/simpan-data-tugasakhir', [App\Http\Controllers\AdminTugasAkhirController::class, 'simpan']);
    Route::get('{id}/edit-tugasakhir', [App\Http\Controllers\AdminTugasAkhirController::class, 'edit']);
    Route::post('/update-tugasakhir/{id}', [App\Http\Controllers\AdminTugasAkhirController::class, 'update']);
    Route::post('/status-tugasakhir/{id}', [App\Http\Controllers\AdminTugasAkhirController::class, 'status']);
    Route::get('{id}/hapus-tugasakhir', [App\Http\Controllers\AdminTugasAkhirController::class, 'hapus']);
    Route::get('/downloadpdf-tugasakhir', [App\Http\Controllers\AdminTugasAkhirController::class, 'downloadpdf']);

    // halaman admin poster
    Route::get('/admin-poster', [App\Http\Controllers\AdminPosterController::class, 'index']);
    Route::post('/simpan-data-poster', [App\Http\Controllers\AdminPosterController::class, 'simpan']);
    Route::get('{id}/edit-poster', [App\Http\Controllers\AdminPosterController::class, 'edit']);
    Route::post('/update-poster/{id}', [App\Http\Controllers\AdminPosterController::class, 'update']);
    Route::post('/status-poster/{id}', [App\Http\Controllers\AdminPosterController::class, 'status']);
    Route::get('{id}/hapus-poster', [App\Http\Controllers\AdminPosterController::class, 'hapus']);
    Route::get('/downloadpdf-poster', [App\Http\Controllers\AdminPosterController::class, 'downloadpdf']);

    // halaman admin event
    Route::get('/admin-event', [App\Http\Controllers\AdminEventController::class, 'index']);
    Route::post('/simpan-data-event', [App\Http\Controllers\AdminEventController::class, 'simpan']);
    Route::get('{id}/edit-event', [App\Http\Controllers\AdminEventController::class, 'edit']);
    Route::post('/update-event/{id}', [App\Http\Controllers\AdminEventController::class, 'update']);
    Route::get('{id}/hapus-event', [App\Http\Controllers\AdminEventController::class, 'hapus']);

    // halaman admin berita
    Route::get('/admin-berita', [App\Http\Controllers\AdminBeritaController::class, 'index']);
    Route::post('/simpan-data-berita', [App\Http\Controllers\AdminBeritaController::class, 'simpan']);
    Route::get('{id}/edit-berita', [App\Http\Controllers\AdminBeritaController::class, 'edit']);
    Route::post('/update-berita/{id}', [App\Http\Controllers\AdminBeritaController::class, 'update']);
    Route::get('{id}/hapus-berita', [App\Http\Controllers\AdminBeritaController::class, 'hapus']);

    // halaman admin publikasi
    Route::get('/admin-publikasi', [App\Http\Controllers\AdminPublikasiController::class, 'index']);
    Route::post('/simpan-data-publikasi', [App\Http\Controllers\AdminPublikasiController::class, 'simpan']);
    Route::get('{id}/edit-publikasi', [App\Http\Controllers\AdminPublikasiController::class, 'edit']);
    Route::post('/update-publikasi/{id}', [App\Http\Controllers\AdminPublikasiController::class, 'update']);
    Route::get('{id}/hapus-publikasi', [App\Http\Controllers\AdminPublikasiController::class, 'hapus']);

    // halaman admin sertifikat
    Route::get('/admin-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'index']);
    Route::post('/simpan-data-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'simpan']);
    Route::get('{id}/edit-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'edit']);
    Route::post('/update-sertifikat/{id}', [App\Http\Controllers\AdminSertifikatController::class, 'update']);
    Route::get('{id}/hapus-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'hapus']);

    // halaman admin loker
    Route::get('/admin-loker', [App\Http\Controllers\AdminLokerController::class, 'index']);
    Route::post('/simpan-data-loker', [App\Http\Controllers\AdminLokerController::class, 'simpan']);
    Route::get('{id}/edit-loker', [App\Http\Controllers\AdminLokerController::class, 'edit']);
    Route::post('/update-loker/{id}', [App\Http\Controllers\AdminLokerController::class, 'update']);
    Route::get('{id}/hapus-loker', [App\Http\Controllers\AdminLokerController::class, 'hapus']);
});

// Halaman untuk anggota
Route::group(['middleware' => ['auth', RoleMiddleware::class.':Anggota']], function () {
    // halaman anggota
    Route::get('/publikasi', [App\Http\Controllers\PublikasiController::class, 'index']);
    Route::get('/loker', [App\Http\Controllers\LokerController::class, 'index']);

    // profil
    Route::get('/profil-anggota', [App\Http\Controllers\ProfilAnggotaController::class, 'index']);
    Route::post('/ubah-profil/{id}', [App\Http\Controllers\ProfilAnggotaController::class, 'image']);
    Route::post('/ubah-login/{id}', [App\Http\Controllers\ProfilAnggotaController::class, 'login']);
    Route::post('/ubah-anggota/{id}', [App\Http\Controllers\ProfilAnggotaController::class, 'anggota']);

    // prestasi
    Route::post('/simpan-data-artikel-anggota', [App\Http\Controllers\PrestasiController::class, 'simpanArtikel']);
    Route::post('/simpan-data-haki-anggota', [App\Http\Controllers\PrestasiController::class, 'simpanHaki']);
    Route::post('/simpan-data-tugasakhir-anggota', [App\Http\Controllers\PrestasiController::class, 'simpanTugasakhir']);

    // galeri poster
    Route::post('/simpan-data-poster-anggota', [App\Http\Controllers\PosterController::class, 'simpan']);

    // riwayat pengajuan prestasi
    Route::get('/riwayat-pengajuan', [App\Http\Controllers\RiwayatPengajuanController::class, 'index']);
    Route::post('/update-artikel-anggota/{id}', [App\Http\Controllers\RiwayatPengajuanController::class, 'updateArtikel']);
    Route::post('/update-haki-anggota/{id}', [App\Http\Controllers\RiwayatPengajuanController::class, 'updateHaki']);
    Route::post('/update-tugasakhir-anggota/{id}', [App\Http\Controllers\RiwayatPengajuanController::class, 'updateTugasakhir']);
    Route::post('/update-poster-anggota/{id}', [App\Http\Controllers\RiwayatPengajuanController::class, 'updatePoster']);
    Route::get('{id}/hapus-artikel-anggota', [App\Http\Controllers\RiwayatPengajuanController::class, 'hapusArtikel']);
    Route::get('{id}/hapus-haki-anggota', [App\Http\Controllers\RiwayatPengajuanController::class, 'hapusHaki']);
    Route::get('{id}/hapus-tugasakhir-anggota', [App\Http\Controllers\RiwayatPengajuanController::class, 'hapusTugasakhir']);
    Route::get('{id}/hapus-poster-anggota', [App\Http\Controllers\RiwayatPengajuanController::class, 'hapusPoster']);
});