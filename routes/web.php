<?php

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\FpdiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SignController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'dashboard']);
Route::get('/admin', [HomeController::class, 'admin']);
// $link = '/verifikasi/'.urlencode('lita/amelia');
// Route::get('/verifikasi/{qrcodes}', [HomeController::class, 'verifikasi'])->name("verifikasi");
Route::get('/verifikasi', [HomeController::class, 'verifikasi'])->name("verifikasi");

Route::get('/users', [AuthController::class, 'index']);
Route::post('/users/action/{user}', [AuthController::class, 'action'])->name("user.action");
Route::get('/login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showFormRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/kategori/checkSlug', [KategoriController::class, 'checkSlug'])->name("checkSlug");
Route::resource('/kategori', KategoriController::class)->parameters([
    'kategori' => 'kategori:slug'])->middleware('admin');

Route::get('/dokumen/checkSlug', [DokumenController::class, 'checkSlug'])->name("checkSlug");
Route::resource('/dokumen', DokumenController::class)->parameters([
    'dokumen' => 'dokumen:slug',
]);


// Route::resource('/qrcode', QrcodeController::class);

Route::get('/qrcode', [QrcodeController::class, 'index']);
Route::post('/qrcode', [QrcodeController::class, 'store'])->name('qrcode.store');
Route::get('/qrcode/{dokumen}/create', [QrcodeController::class, 'create']);
Route::get('/cetak/{qrcode:hash}', [QrcodeController::class, 'print']);
Route::delete('/qrcode/{qrcode}', [QrcodeController::class, 'destroy']);

// Route::get('/coba', [HomeController::class, 'index']);
// Route::get('/coba/cari', [HomeController::class, 'cobacari'])->name('cari');

// Route::get('/sign', [SignController::class, 'index'])->name('sign');
Route::get('/search', [HomeController::class, 'search'])->name('search');

