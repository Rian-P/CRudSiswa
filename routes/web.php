<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
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

Route::middleware(['auth'])->group(function () {
Route::get('/home',[HomeController::class, 'index'])->name('home.index');
Route::get('/siswa',[SiswaController::class, 'index'])->name('siswa.index');
Route::get('/tambahsiswa',[SiswaController::class, 'create'])->name('siswa.tambah');
Route::post('/tambahsiswa',[SiswaController::class, 'store'])->name('siswa.store');
Route::get('/lembaga',[lembagaController::class, 'index'])->name('lembaga.index');
Route::post('/lembaga',[lembagaController::class, 'tambahlembaga'])->name('lembaga.tambah');

});


Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login',[AuthController::class, 'login'])->name('login.store');
Route::get('/logout',[AuthController::class, 'logout']);
