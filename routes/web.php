<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/cycles', [HomeController::class, 'cycles'])->name('admin.cycles.index');
Route::get('/admin/cycles/order', [HomeController::class, 'order'])->name('admin.cycles.order');
Route::get('/admin/qr/index', [HomeController::class, 'qrgenerator'])->name('admin.qr.index');
Route::get('/admin/qr/scan-qr', [HomeController::class, 'scanQr'])->name('admin.qr.scan-qr');
