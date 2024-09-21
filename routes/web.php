<?php

use Illuminate\Support\Facades\Route;

// Welcome
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

Auth::routes();

// halaman umum
Route::get('/divisi/{id}', [App\Http\Controllers\DivisiController::class, 'index']);
Route::get('/berita/{id}', [App\Http\Controllers\BeritaController::class, 'show']);
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index']);
Route::get('/event', [App\Http\Controllers\EventController::class, 'index']);
Route::get('/event/{category?}', [App\Http\Controllers\EventController::class, 'index']);
Route::get('/publikasi', [App\Http\Controllers\PublikasiController::class, 'index']);
Route::get('/sertifikat', [App\Http\Controllers\SertifikatController::class, 'index']);
Route::get('/loker', [App\Http\Controllers\LokerController::class, 'index']);

// profil
Route::get('/profil-anggota', [App\Http\Controllers\ProfilAnggotaController::class, 'index']);
Route::post('/ubah-profil/{id}', [App\Http\Controllers\ProfilAnggotaController::class, 'image']);
Route::post('/ubah-login/{id}', [App\Http\Controllers\ProfilAnggotaController::class, 'login']);
Route::post('/ubah-anggota/{id}', [App\Http\Controllers\ProfilAnggotaController::class, 'anggota']);

// Dashboard admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// halaman admin users
Route::get('/admin-users', [App\Http\Controllers\AdminUsersController::class, 'index']);
Route::post('/simpan-data-users', [App\Http\Controllers\AdminUsersController::class, 'simpan']);
Route::get('{id}/edit-users', [App\Http\Controllers\AdminUsersController::class, 'edit']);
Route::post('/update-users/{id}', [App\Http\Controllers\AdminUsersController::class, 'update']);
Route::get('{id}/hapus-users', [App\Http\Controllers\AdminUsersController::class, 'hapus']);
Route::get('/downloadpdf-users', [App\Http\Controllers\AdminUsersController::class, 'downloadpdf']);

// halaman admin divisi
Route::get('/admin-divisi', [App\Http\Controllers\AdminDivisiController::class, 'index']);
Route::post('/simpan-data-divisi', [App\Http\Controllers\AdminDivisiController::class, 'simpan']);
Route::get('{id}/edit-divisi', [App\Http\Controllers\AdminDivisiController::class, 'edit']);
Route::post('/update-divisi/{id}', [App\Http\Controllers\AdminDivisiController::class, 'update']);
Route::get('{id}/hapus-divisi', [App\Http\Controllers\AdminDivisiController::class, 'hapus']);
Route::get('/downloadpdf-divisi', [App\Http\Controllers\AdminDivisiController::class, 'downloadpdf']);

// halaman admin jabatan
Route::get('/admin-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'index']);
Route::post('/simpan-data-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'simpan']);
Route::get('{id}/edit-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'edit']);
Route::post('/update-jabatan/{id}', [App\Http\Controllers\AdminJabatanController::class, 'update']);
Route::get('{id}/hapus-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'hapus']);
Route::get('/downloadpdf-jabatan', [App\Http\Controllers\AdminJabatanController::class, 'downloadpdf']);

// halaman admin angggota
Route::get('/admin-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'index']);
Route::post('/simpan-data-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'simpan']);
Route::get('{id}/edit-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'edit']);
Route::post('/update-anggota/{id}', [App\Http\Controllers\AdminAnggotaController::class, 'update']);
Route::get('{id}/hapus-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'hapus']);
Route::get('/downloadpdf-anggota', [App\Http\Controllers\AdminAnggotaController::class, 'downloadpdf']);

// halaman admin proker
Route::get('/admin-proker', [App\Http\Controllers\AdminProkerController::class, 'index']);
Route::post('/simpan-data-proker', [App\Http\Controllers\AdminProkerController::class, 'simpan']);
Route::get('{id}/edit-proker', [App\Http\Controllers\AdminProkerController::class, 'edit']);
Route::post('/update-proker/{id}', [App\Http\Controllers\AdminProkerController::class, 'update']);
Route::get('{id}/hapus-proker', [App\Http\Controllers\AdminProkerController::class, 'hapus']);
Route::get('/downloadpdf-proker', [App\Http\Controllers\AdminProkerController::class, 'downloadpdf']);

// halaman admin event
Route::get('/admin-event', [App\Http\Controllers\AdminEventController::class, 'index']);
Route::post('/simpan-data-event', [App\Http\Controllers\AdminEventController::class, 'simpan']);
Route::get('{id}/edit-event', [App\Http\Controllers\AdminEventController::class, 'edit']);
Route::post('/update-event/{id}', [App\Http\Controllers\AdminEventController::class, 'update']);
Route::get('{id}/hapus-event', [App\Http\Controllers\AdminEventController::class, 'hapus']);
Route::get('/downloadpdf-event', [App\Http\Controllers\AdminEventController::class, 'downloadpdf']);

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
Route::get('/downloadpdf-publikasi', [App\Http\Controllers\AdminPublikasiController::class, 'downloadpdf']);

// halaman admin sertifikat
Route::get('/admin-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'index']);
Route::post('/simpan-data-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'simpan']);
Route::get('{id}/edit-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'edit']);
Route::post('/update-sertifikat/{id}', [App\Http\Controllers\AdminSertifikatController::class, 'update']);
Route::get('{id}/hapus-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'hapus']);
Route::get('/downloadpdf-sertifikat', [App\Http\Controllers\AdminSertifikatController::class, 'downloadpdf']);

// halaman admin loker
Route::get('/admin-loker', [App\Http\Controllers\AdminLokerController::class, 'index']);
Route::post('/simpan-data-loker', [App\Http\Controllers\AdminLokerController::class, 'simpan']);
Route::get('{id}/edit-loker', [App\Http\Controllers\AdminLokerController::class, 'edit']);
Route::post('/update-loker/{id}', [App\Http\Controllers\AdminLokerController::class, 'update']);
Route::get('{id}/hapus-loker', [App\Http\Controllers\AdminLokerController::class, 'hapus']);
Route::get('/downloadpdf-loker', [App\Http\Controllers\AdminLokerController::class, 'downloadpdf']);