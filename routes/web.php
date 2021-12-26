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
})->name('Class');Route::get('/updateClass/{name}', [ClassroomController::class,'updateClass'])->name('updateClassGet')->middleware('Teacher');

Route::post('/updateClass/{id}', [ClassroomController::class,'updateClass'])->name('updateClassPost')->middleware('Teacher');  

Route::post('/AddClass',[ClassroomController::class,'addClass'])->name('addClass')->middleware('Teacher');

Route::get('/showClass',[ClassroomController::class,'showClass'])->name('showClass')->middleware('Teacher','auth');

Route::get('/Class/{id}', [ClassroomController::class,'showSingleClass'])->name('showSingleClass')->middleware('Teacher','auth');

Route::get('/UpdateClassView/{id}', [ClassroomController::class,'getUpdateClass'])->name('updateSingleClass')->middleware('Teacher');

Route::get('/deleteClass/{id}', [ClassroomController::class,'deleteClass'])->name('deleteClass')->middleware('Teacher');   

//Bạch
Route::get('/', function () {
    return view('/Login');
})->name('Login');

Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage');

Route::get('/Login', [DangNhapController::class,'dangNhap'])->name('Login')->middleware('guest');
Route::post('/Login', [DangNhapController::class,'xuLyDangNhap'])->name('xl-dang-nhap');

Route::get('/ForgotPassword', [DangNhapController::class,'forgotPassword'])->name('/ForgotPassword');
Route::post('/ForgotPassword', [DangNhapController::class,'xuLyMatKhau'])->name('xl-mat-khau');

Route::get('/Password/{id}', [DangNhapController::class,'Password'])->name('/Password');
Route::post('/Password/{id}', [DangNhapController::class,'taoMoiMatKhau'])->name('mat-khau-moi');

Route::get('/dangXuat', [DangNhapController::class,'dangXuat'])->name('dangXuat');

Route::post('/joinClass',[ClassroomController::class,'joinClass'])->name('joinClass');
 
Route::get('/Students',[StudentController::class,'layDanhSachSV'])->name('StudentsList');
Route::get('/Students/Add',[StudentController::class,'themSV'])->name('loadThemSV');
Route::post('/Students/Add',[StudentController::class,'xlThemSV'])->name('xlThemSV');
Route::get('/Students/Update/{id}',[StudentController::class,'suaSV'])->name('loadSuaSV');
Route::post('/Students/Update/{id}',[StudentController::class,'xlSuaSV'])->name('xlSuaSV');