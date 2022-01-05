<?php
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\StudentListController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Khánh
Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage');

Route::get('/AddClass', function () {
    return view('Teacher/AddClass');
})->name('Addclass');

Route::get('/AddClassStudent', function () {
    return view('Student/JoinClass');
})->name('AddClassStudent');

Route::get('/Class', function () {
    return view('Class');
})->name('Class');Route::get('/updateClass/{name}', [ClassroomController::class,'updateClass'])->name('updateClassGet');

//<-                Classroom                 ->
//-----------------------------//
Route::get('/showClassStudent',[StudentController::class,'showClassStudent'])->name('showClassStudent')->middleware('auth');
Route::group(['prefix'=>'/', 'middleware' => ['auth','giangvien','login']],function(){

Route::get('/showClass',[ClassroomController::class,'showClass'])->name('showClass');


Route::post('/updateClass/{id}', [ClassroomController::class,'updateClass'])->name('updateClassPost');  

Route::post('/AddClass',[ClassroomController::class,'addClass'])->name('addClass');

Route::get('/Class/{id}', [ClassroomController::class,'showSingleClass'])->name('showSingleClass');

Route::get('ClassStudent/{id}', [ClassroomController::class,'showSingleClassStudent'])->name('showSingleClassStudent');

Route::get('/UpdateClassView/{id}', [ClassroomController::class,'getUpdateClass'])->name('updateSingleClassGet');

Route::post('/UpdateClassView/{id}', [ClassroomController::class,'getUpdateClass'])->name('updateSingleClassPost');

Route::get('/deleteClass/{id}', [ClassroomController::class,'deleteClass'])->name('deleteClass');   

Route::post('/deleteClass/{id}', [ClassroomController::class,'deleteClass'])->name('deleteClass'); 

Route::post('/randomCode', [ClassroomController::class,'randomCode'])->name('randomCode');   

Route::get('/randomCode', [ClassroomController::class,'randomCode'])->name('randomCode');   

Route::get('/lstStudent/{id}',[ClassroomController::class,'dsSinhVien'] )->name('lstStudent');

Route::get('/ListStudent', [ClassroomController::class,'dsSinhVien']);

Route::post('/ListStudent/{id}', [StudentListController::class,'AddStudent'])->name('dsSinhVienPost');

Route::get('/ListStudent/Delete/{id}/{code}', [StudentListController::class,'DeleteStudent'])->name('xoaSinhvien');

});

//Bạch
Route::get('/', function () {
    return view('/Login');
})->name('Login')->middleware('logout');

Route::get('/Login', [DangNhapController::class,'dangNhap'])->name('Login')->middleware('logout');
Route::post('/Login', [DangNhapController::class,'xuLyDangNhap'])->name('xl-dang-nhap')->middleware('logout');

Route::get('/ForgotPassword', [DangNhapController::class,'forgotPassword'])->name('/ForgotPassword')->middleware('logout');
Route::post('/ForgotPassword', [DangNhapController::class,'xuLyMatKhau'])->name('xl-mat-khau')->middleware('logout');

Route::get('/Password/{id}', [DangNhapController::class,'Password'])->name('/Password')->middleware('logout');
Route::post('/Password/{id}', [DangNhapController::class,'taoMoiMatKhau'])->name('mat-khau-moi')->middleware('logout');

Route::get('/dangXuat', [DangNhapController::class,'dangXuat'])->name('dangXuat');

Route::group(['prefix'=>'/', 'middleware' => ['auth','admin','login']],function(){

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
Route::get('/Admin/Teachers/Delete/{id}',[TeacherController::class,'xoaGV'])->name('xoaGV');

Route::get('/Admin/Classrooms',[ClassroomController::class,'layDSLopHoc'])->name('ClassroomsList');
Route::get('/Admin/Classrooms/StudentsList/{id}',[ClassroomController::class,'layDSSVTL'])->name('loadDSSV');
Route::post('/Admin/Classrooms/StudentsList/Add/{id}',[StudentListController::class,'AddStudentAdmin'])->name('xlThemSVTL');
Route::get('/Admin/Classrooms/StudentsList/Delete/{id}/{code}', [StudentListController::class,'DeleteStudentAdmin'])->name('xlXoaSVTL');

Route::get('/Admin/Admins',[AdminController::class,'layDanhSachAd'])->name('AdminsList');
Route::get('/Admin/Admins/Add',[AdminController::class,'themAd'])->name('loadThemAd');
Route::post('/Admin/Admins/Add',[AdminController::class,'xlThemAd'])->name('xlThemAd');
Route::get('/Admin/Admins/Update/{id}',[AdminController::class,'suaAd'])->name('loadSuaAd');
Route::post('/Admin/Admins/Update/{id}',[AdminController::class,'xlSuaAd'])->name('xlSuaAd');
Route::get('/Admin/Admins/Delete/{id}',[AdminController::class,'xoaAd'])->name('xoaAd');

Route::get('/Admin/UnknowAccount/', function () {
    return view('UnknowAccount');
})->name('error');


Route::get('/Admin', function () {
    return view('Admin');
})->name('Admin')->middleware('login');
});
//<-                Account                 ->
Route::get('/loadAccount',[AccountController::class,'loadAccount'])->name('loadAccount');

Route::post('/updateAccount',[AccountController::class,'updateAccount'])->name('updateAccount');

Route::post('Student/AddClass',[StudentController::class,'addClassStudent'])->name('addClassStudent');

Route::get('/logout',[DangNhapController::class,'dangXuat'])->name('Logout');
