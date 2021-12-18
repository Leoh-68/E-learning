<?php
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DangNhapController;
use Illuminate\Support\Facades\Route;
// Khánh
Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage');

Route::get('/AddClass', function () {
    return view('AddClass');
})->name('Addclass');

Route::get('/Class', function () {
    return view('Class');
})->name('Class');Route::get('/updateClass/{name}', [ClassroomController::class,'updateClass'])->name('updateClassGet');

Route::post('/updateClass/{id}', [ClassroomController::class,'updateClass'])->name('updateClassPost');  

Route::post('/AddClass',[ClassroomController::class,'addClass'])->name('addClass');

Route::get('/showClass',[ClassroomController::class,'showClass'])->name('showClass');

Route::get('/Class/{id}', [ClassroomController::class,'showSingleClass'])->name('showSingleClass');

Route::get('/UpdateClassView/{id}', [ClassroomController::class,'getUpdateClass'])->name('updateSingleClass');

Route::get('/deleteClass/{id}', [ClassroomController::class,'deleteClass'])->name('deleteClass');   

//Bạch
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

