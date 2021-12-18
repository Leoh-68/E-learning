<?php

use App\Http\Controllers\DangNhapController;
use Illuminate\Support\Facades\Route;

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
    return view('/Login');
})->name('Login');

Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage')->middleware('auth');

Route::get('/Login', [DangNhapController::class,'dangNhap'])->name('Login')->middleware('guest');
Route::post('/Login', [DangNhapController::class,'xuLyDangNhap'])->name('xl-dang-nhap');
Route::get('/Logout', [DangNhapController::class,'dangXuat'])->name('Logout');
//Route::get('/mk', [DangNhapController::class,'update'])->name('Login'); mã hóa mật khẩu
Route::get('/ForgotPassword', [DangNhapController::class,'forgotPassword'])->name('/ForgotPassword');
Route::post('/ForgotPassword', [DangNhapController::class,'xuLyMatKhau'])->name('xl-mat-khau');
