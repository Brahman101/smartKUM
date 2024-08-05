<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SKPDController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\KasubagController;
use App\Http\Controllers\KabagController;
use App\Http\Controllers\KepalaDinasController;
use App\Http\Controllers\SekdaController;
use App\Http\Controllers\WalikotaController;
use App\Models\ProdukHukum;

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
    return view('JDIH.beranda');
})->middleware('guest')->name('beranda');

Route::get('/kontak', function () {
    return view('JDIH.kontak');
})->middleware('guest')->name('kontak');

Route::get('/faq', function () {
    return view('JDIH.FAQ');
})->middleware('guest')->name('faq');

Route::get('/media1', function () {
    return view('JDIH.media1');
})->middleware('guest')->name('media1');

Route::get('/media2', function () {
    return view('JDIH.media2');
})->middleware('guest')->name('media2');

Route::get('/beranda', [DashboardController::class, 'dashboard'])->middleware('guest');
Route::get('/dashboard/readprodukhukum/{id}', [DashboardController::class, 'readprodukhukum'])->middleware('guest');

Route::get('/inovasisimprokum', [DashboardController::class, 'inovasisimprokum'])->middleware('guest');


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/status', [LoginController::class, 'status']);
Route::post('/status', [LoginController::class, 'searchstatus']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/profile', [DashboardController::class, 'profile']);
    Route::put('/dashboard/editProfile/{id}', [DashboardController::class, 'editProfile']);
});

// Superadmin
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/dashboard/jenis', [SuperAdminController::class, 'jenis']);
    Route::get('/dashboard/user', [SuperAdminController::class, 'user']);
    Route::get('/dashboard/dinas', [SuperAdminController::class, 'dinas']);
    Route::post('/dashboard/addUser', [SuperAdminController::class, 'addUser']);
    Route::put('/dashboard/editUser/{id}', [SuperAdminController::class, 'editUser']);
    Route::delete('/dashboard/deleteUser/{id}', [SuperAdminController::class, 'deleteUser']);
    Route::post('/dashboard/addDinas', [SuperAdminController::class, 'addDinas']);
    Route::put('/dashboard/editDinas/{id}', [SuperAdminController::class, 'editDinas']);
    Route::delete('/dashboard/deleteDinas/{id}', [SuperAdminController::class, 'deleteDinas']);
    Route::post('/dashboard/addJenis', [SuperAdminController::class, 'addjenis']);
    Route::put('/dashboard/editJenis/{id}', [SuperAdminController::class, 'editJenis']);
    Route::delete('/dashboard/deleteJenis/{id}', [SuperAdminController::class, 'deleteJenis']);
});

// SKPD
Route::middleware(['auth', 'role:skpd'])->group(function () {
    Route::get('/dashboard/skpd/addprodukhukum', [SKPDController::class, 'addprodukhukum']);
    Route::post('/dashboard/skpd/addprodukhukum', [SKPDController::class, 'storeprodukhukum']);
    Route::get('/dashboard/skpd/readprodukhukum/{id}', [SKPDController::class, 'readprodukhukum']);
    Route::get('/dashboard/skpd/editprodukhukum/{id}', [SKPDController::class, 'editprodukhukum']);
    Route::put('/dashboard/skpd/editprodukhukum/{id}', [SKPDController::class, 'updateprodukhukum']);
    Route::delete('/dashboard/skpd/deleteprodukhukum/{id}', [SKPDController::class, 'deleteprodukhukum']);
});

// Admin FO
Route::middleware(['auth', 'role:admin_fo'])->group(function () {
    Route::get('/dashboard/admin/readprodukhukum/{id}', [AdminController::class, 'readprodukhukum']);
    Route::post('/dashboard/admin/process/{id}', [AdminController::class, 'process']);
});

// Staff Perundang Undangan
Route::middleware(['auth', 'role:staff_perundang_undangan'])->group(function () {
    Route::get('/dashboard/staffu/editprodukhukum/{id}', [StaffController::class, 'editprodukhukum']);
    Route::put('/dashboard/staffu/editprodukhukum/{id}', [StaffController::class, 'updateprodukhukum']);
    Route::get('/dashboard/staffu/readprodukhukum/{id}', [StaffController::class, 'readprodukhukum']);
});

// Kasubag Perundang Undangan
Route::middleware(['auth', 'role:kasubag_perundang_undangan'])->group(function () {
    Route::get('/dashboard/kasubagu/readprodukhukum/{id}', [KasubagController::class, 'editprodukhukum']);
    Route::post('/dashboard/kasubagu/process/{id}', [KasubagController::class, 'process']);
});

// Kabag
Route::middleware(['auth', 'role:kabag'])->group(function () {
    Route::get('/dashboard/kabag/readprodukhukum/{id}', [KabagController::class, 'editprodukhukum']);
    Route::post('/dashboard/kabag/process/{id}', [KabagController::class, 'process']);
});

// Kepala Dinas
Route::middleware(['auth', 'role:kepala_dinas'])->group(function () {
    Route::get('/dashboard/kepaladinas/readprodukhukum/{id}', [KepalaDinasController::class, 'editprodukhukum']);
    Route::post('/dashboard/kepaladinas/process/{id}', [KepalaDinasController::class, 'process']);
});

// Sekda
Route::middleware(['auth', 'role:sekda'])->group(function () {
    Route::get('/dashboard/sekda/readprodukhukum/{id}', [SekdaController::class, 'editprodukhukum']);
    Route::post('/dashboard/sekda/process/{id}', [SekdaController::class, 'process']);
});

// Walikota
Route::middleware(['auth', 'role:walikota'])->group(function () {
    Route::get('/dashboard/walikota/readprodukhukum/{id}', [WalikotaController::class, 'editprodukhukum']);
    Route::post('/dashboard/walikota/process/{id}', [WalikotaController::class, 'process']);
});

// Staff Dokumentasi
Route::middleware(['auth', 'role:staff_dokumentasi'])->group(function () {
    Route::get('/dashboard/katalogprodukhukum', [StaffController::class, 'katalogprodukhukum']);
    Route::get('/dashboard/staffd/editprodukhukum/{id}', [StaffController::class, 'editprodukhukum2']);
    Route::get('/dashboard/staffd/editkatalogprodukhukum/{id}', [StaffController::class, 'editprodukhukumlama']);
    Route::get('/dashboard/staffd/readprodukhukum/{id}', [StaffController::class, 'readprodukhukum2']);
    Route::get('/dashboard/staffd/metadata/{id}', [StaffController::class, 'next']);
    Route::post('/dashboard/staffd/process/{id}', [StaffController::class, 'process']);
    Route::post('/dashboard/staffd/editmetadata/{id}', [StaffController::class, 'editmetadata']);
    Route::get('/dashboard/staffd/addprodukhukum', [StaffController::class, 'addprodukhukum']);
    Route::post('/dashboard/staffd/addprodukhukum', [StaffController::class, 'storeprodukhukum']);
});

// Kasubag Dokumentasi
Route::middleware(['auth', 'role:kasubag_dokumentasi'])->group(function () {
    Route::get('/dashboard/kasubagd/editprodukhukum/{id}', [KasubagController::class, 'editprodukhukum2']);
    Route::post('/dashboard/kasubagd/process/{id}', [KasubagController::class, 'process2']);
    Route::get('/dashboard/kasubagd/readprodukhukum/{id}', [KasubagController::class, 'readprodukhukum2']);
    Route::get('/dashboard/kasubagd/publikasi', [KasubagController::class, 'publikasi']);
});
