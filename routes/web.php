<?php
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
// Khánh
Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage');

Route::get('/AddClass', function () {
    return view('Teacher/AddClass');
})->name('Addclass');

Route::get('/Class', function () {
    return view('Class');
})->name('Class');Route::get('/updateClass/{name}', [ClassroomController::class,'updateClass'])->name('updateClassGet');


//-----------------------------//
Route::get('/showClass',[ClassroomController::class,'showClass'])->name('showClass');

Route::get('/showClassStudent',[ClassroomController::class,'showClassStudent'])->name('showClassStudent');

Route::get('/showClassAdmin',[ClassroomController::class,'showClassAdmin'])->name('showClassAdmin');
//-----------------------------//
Route::post('/updateClass/{id}', [ClassroomController::class,'updateClass'])->name('updateClassPost');  

Route::post('/AddClass',[ClassroomController::class,'addClass'])->name('addClass');

Route::get('/Class/{id}', [ClassroomController::class,'showSingleClass'])->name('showSingleClass');

Route::get('/UpdateClassView/{id}', [ClassroomController::class,'getUpdateClass'])->name('updateSingleClassGet');

Route::post('/UpdateClassView/{id}', [ClassroomController::class,'getUpdateClass'])->name('updateSingleClassPost');

Route::get('/deleteClass/{id}', [ClassroomController::class,'deleteClass'])->name('deleteClass');   

Route::post('/deleteClass/{id}', [ClassroomController::class,'deleteClass'])->name('deleteClass'); 

Route::post('/randomCode', [ClassroomController::class,'randomCode'])->name('randomCode');   

Route::get('/randomCode', [ClassroomController::class,'randomCode'])->name('randomCode');   
//Bạch
Route::get('/', function () {
    return view('/Login');
})->name('Login');

Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage')->middleware('auth');

Route::get('/Login', [DangNhapController::class,'dangNhap'])->name('Login')->middleware('guest');
Route::post('/Login', [DangNhapController::class,'xuLyDangNhap'])->name('xl-dang-nhap');
//Route::get('/mk', [DangNhapController::class,'update'])->name('Login'); mã hóa mật khẩu
Route::get('/ForgotPassword', [DangNhapController::class,'forgotPassword'])->name('/ForgotPassword');
Route::post('/ForgotPassword', [DangNhapController::class,'xuLyMatKhau'])->name('xl-mat-khau');


Route::get('/Admin/Students',[StudentController::class,'layDanhSachSV'])->name('StudentsList');
Route::get('/Admin/Students/Add',[StudentController::class,'themSV'])->name('loadThemSV');
Route::post('/Admin/Students/Add',[StudentController::class,'xlThemSV'])->name('xlThemSV');
Route::get('/Admin/Students/Update/{id}',[StudentController::class,'suaSV'])->name('loadSuaSV');
Route::post('/Admin/Students/Update/{id}',[StudentController::class,'xlSuaSV'])->name('xlSuaSV');
Route::get('/Admin/Students/Deleted/{id}',[StudentController::class,'xoaSV'])->name('xoaSV');

Route::get('/Admin/Teachers',[TeacherController::class,'layDanhSachGV'])->name('TeachersList');
Route::get('/Admin/Teachers/Add',[TeacherController::class,'themGV'])->name('loadThemGV');
Route::post('/Admin/Teachers/Add',[TeacherController::class,'xlThemGV'])->name('xlThemGV');
Route::get('/Admin/Teachers/Update/{id}',[TeacherController::class,'suaGV'])->name('loadSuaGV');
Route::post('/Admin/Teachers/Update/{id}',[TeacherController::class,'xlSuaGV'])->name('xlSuaGV');
Route::get('/Admin/Teachers/Deleted/{id}',[TeacherController::class,'xoaGV'])->name('xoaGV');

Route::get('/Admin', function () {
    return view('Admin');
})->name('Admin');

Route::get('/loadAccount',[AccountController::class,'loadAccount'])->name('loadAccount');