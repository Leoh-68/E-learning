<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\StudentListController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Khánh
Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage');

Route::group(['middleware' => ['login']],function(){

Route::get('/AddClassStudent', function () {
    return view('Student/JoinClass');
})->name('AddClassStudent');

Route::get('/Class', function () {
    return view('Class');
})->name('Class');
Route::get('/updateClass/{name}', [ClassroomController::class, 'updateClass'])->name('updateClassGet');

Route::group(['prefix'=>'/', 'middleware' => ['giangvien']],function(){

    Route::get('/showClass',[ClassroomController::class,'showClass'])->name('showClass');

    Route::get('/AddClass', function () {
        return view('Teacher/AddClass');
    })->name('Addclass');

//<-                Classroom                 ->
//-----------------------------//
Route::get('/Class', [ClassroomController::class, 'showClass'])->name('showClass');

Route::get('/Student/Class', [StudentController::class, 'showClassStudent'])->name('showClassStudent');
//-----------------------------//
Route::post('/updateClass/{id}', [ClassroomController::class, 'updateClass'])->name('updateClassPost');
Route::post('/Class/Add', [ClassroomController::class, 'addClass'])->name('addClass');
Route::get('/Class/{id}', [ClassroomController::class, 'showSingleClass'])->name('showSingleClass');
Route::get('ClassStudent/{id}', [ClassroomController::class, 'showSingleClassStudent'])->name('showSingleClassStudent');
Route::get('/Class/Update/{id}', [ClassroomController::class, 'getUpdateClass'])->name('updateSingleClassGet');
Route::post('/Class/Update/{id}', [ClassroomController::class, 'updateClass'])->name('updateSingleClassPost');
Route::get('/Class/Delete/{id}', [ClassroomController::class, 'deleteClass'])->name('deleteClass');
Route::post('/Class/Delete/{id}', [ClassroomController::class, 'deleteClass'])->name('deleteClassPost');
Route::post('/randomCode', [ClassroomController::class, 'randomCode'])->name('randomCode');
Route::get('/randomCode', [ClassroomController::class, 'randomCode'])->name('randomCode');
Route::get('/List/{id}', [ClassroomController::class, 'listStudent'])->name('lstStudent');
Route::get('/ListWait/{id}', [ClassroomController::class, 'listStudentWaiting'])->name('lstStudentWating');
Route::get('/AcceptStudent/{class}/{account}', [StudentListController::class, 'acceptStudent'])->name('acceptStudent');
Route::get('/ListStudent', [ClassroomController::class, 'listStudent']);
Route::post('/ListStudent/{id}', [StudentListController::class, 'AddStudent'])->name('dsSinhVienPost');
Route::get('/ListStudent/Delete/{id}/{code}', [StudentListController::class, 'DeleteStudent'])->name('xoaSinhvien');
Route::get('/Class/Post/{id}', [PostController::class, 'post'])->name('post');
Route::post('/Class/Post/{id}', [PostController::class, 'post'])->name('post');
Route::get('/Class/PostShow/{id}', [PostController::class, 'showPost'])->name('ShowPost');
Route::get('/Class/Post/Update/{code}/{id}', [PostController::class, 'updatePostShow'])->name('UpdatePost');
Route::post('/Class/Post/Update/{code}/{id}', [PostController::class, 'updatePost'])->name('UpdatePostP');
Route::get('/Class/Post/Delete/{code}/{id}', [PostController::class, 'deletePost'])->name('DeletePostP');
Route::post('/Class/Post/Delete/{code}/{id}', [PostController::class, 'deletePost'])->name('DeletePostP');
Route::get('/Class/Post/Copy/{id}', [PostController::class,'copyPostShow'])->name('CopyPostG');
Route::post('/Class/Post/Copy/{id}', [PostController::class,'copyPost'])->name('CopyPostP');
Route::get('/Class/Post/View/{id}', [PostController::class,'singlePost'])->name('ViewPost');
Route::post('/Class/Post/HomeWork/{id}', [PostController::class,'homeWork'])->name('HomeWorkP');
Route::get('/Class/Post/HomeWork/{id}', [PostController::class,'homeWork'])->name('HomeWorkG');
Route::get('/Class/Student/Post/{id}', [PostController::class,'singlePostStudent'])->name('ViewPostStudent');
Route::get('/Class/Post/Comment/{idaccount}/{idpost}', [CommentController::class,'addComment'])->name('AddComment');
Route::get('/Class/Comment/Update/{idcomment}', [CommentController::class,'updateCommentShow'])->name('UpdateCommentG');
Route::post('/Class/Comment/Update/{idcomment}', [CommentController::class,'updateComment'])->name('UpdateCommentP');
Route::post('/Class/Comment/Delete/{idcomment}', [CommentController::class,'deleteComment'])->name('DeleteCommentP');
Route::get('/Class/Comment/Delete/{idcomment}', [CommentController::class,'deleteComment'])->name('DeleteCommentG');
Route::post('/SendMail/{name}/{id}', [ClassroomController::class, 'sendMail'])->name("SendMailP");
Route::get('/Accept/{id}/{idclass}', [ClassroomController::class, 'Acp'])->name("AcceptG");
Route::post('/Accept/{id}/{idclass}', [ClassroomController::class, 'Acp'])->name("AcceptP");
Route::post('/ListStudent/Find/{id}', [StudentListController::class, 'findStudent'])->name('FindStudentP');
Route::get('/ListStudent/Find/{id}', [StudentListController::class, 'findStudent'])->name('FindStudentG');
Route::post('/Post/ListHW/{idclass}/{idpost}', [ClassroomController::class, 'ListHomeWork'])->name('ListHWP');
Route::get('/Post/ListHW/{idclass}/{idpost}', [ClassroomController::class, 'ListHomeWork'])->name('ListHWG');
});
//Bạch
Route::get('/', function () {
    return view('Login');
})->name('Login');

Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage')->middleware('auth');
Route::get('/Login', [DangNhapController::class, 'dangNhap'])->name('Login')->middleware('guest');
Route::post('/Login', [DangNhapController::class, 'xuLyDangNhap'])->name('xl-dang-nhap');
//Route::get('/mk', [DangNhapController::class,'update'])->name('Login'); mã hóa mật khẩu
Route::get('/ForgotPassword', [DangNhapController::class, 'forgotPassword'])->name('/ForgotPassword');
Route::post('/ForgotPassword', [DangNhapController::class, 'xuLyMatKhau'])->name('xl-mat-khau');
Route::get('/Class/Post/{id}', [PostController::class, 'Post'])->name('post');
Route::post('/Class/Post/{id}', [PostController::class, 'Post'])->name('post');
Route::group(['prefix'=>'/', 'middleware' => ['auth','admin']],function(){
Route::get('/Admin/Students', [StudentController::class, 'layDanhSachSV'])->name('StudentsList');
Route::get('/Admin/Students/Add', [StudentController::class, 'themSV'])->name('loadThemSV');
Route::post('/Admin/Students/Add', [StudentController::class, 'xlThemSV'])->name('xlThemSV');
Route::get('/Admin/Students/Update/{id}', [StudentController::class, 'suaSV'])->name('loadSuaSV');
Route::post('/Admin/Students/Update/{id}', [StudentController::class, 'xlSuaSV'])->name('xlSuaSV');
Route::get('/Admin/Students/Deleted/{id}', [StudentController::class, 'xoaSV'])->name('xoaSV');

Route::get('/Admin/Teachers', [TeacherController::class, 'layDanhSachGV'])->name('TeachersList');
Route::get('/Admin/Teachers/Add', [TeacherController::class, 'themGV'])->name('loadThemGV');
Route::post('/Admin/Teachers/Add', [TeacherController::class, 'xlThemGV'])->name('xlThemGV');
Route::get('/Admin/Teachers/Update/{id}', [TeacherController::class, 'suaGV'])->name('loadSuaGV');
Route::post('/Admin/Teachers/Update/{id}', [TeacherController::class, 'xlSuaGV'])->name('xlSuaGV');
Route::get('/Admin/Teachers/Delete/{id}', [TeacherController::class, 'xoaGV'])->name('xoaGV');

Route::get('/Admin/Classrooms', [ClassroomController::class, 'layDSLopHoc'])->name('ClassroomsList');
Route::get('/Admin/Classrooms/StudentsList/{id}', [ClassroomController::class, 'layDSSVTL'])->name('loadDSSV');
Route::post('/Admin/Classrooms/StudentsList/Add/{id}', [StudentListController::class, 'AddStudentAdmin'])->name('xlThemSVTL');
Route::get('/Admin/Classrooms/StudentsList/Delete/{id}/{code}', [StudentListController::class, 'DeleteStudentAdmin'])->name('xlXoaSVTL');
Route::get('/Admin/Classrooms/BaiGiang/{id}', [ClassroomController::class, 'layDSBG'])->name('loadBaiGiang');
Route::get('/Admin/Classrooms/BaiTap/{id}', [ClassroomController::class, 'layDSBT'])->name('loadBaiTap');
Route::get('/Admin/XCTBG/{id1}/{id2}', [ClassroomController::class, 'XCTBG'])->name('XCTBG');
Route::get('/Admin/XCTBT/{id1}/{id2}', [ClassroomController::class, 'XCTBT'])->name('XCTBT');

Route::get('/Admin/Admins', [AdminController::class, 'layDanhSachAd'])->name('AdminsList');
Route::get('/Admin/Admins/Add', [AdminController::class, 'themAd'])->name('loadThemAd');
Route::post('/Admin/Admins/Add', [AdminController::class, 'xlThemAd'])->name('xlThemAd');
Route::get('/Admin/Admins/Update/{id}', [AdminController::class, 'suaAd'])->name('loadSuaAd');
Route::post('/Admin/Admins/Update/{id}', [AdminController::class, 'xlSuaAd'])->name('xlSuaAd');
Route::get('/Admin/Admins/Delete/{id}', [AdminController::class, 'xoaAd'])->name('xoaAd');

Route::get('/Admin/UnknowAccount/', function () {
    return view('admin/UnknowAccount');
})->name('error');

Route::get('/Admin', function () {
    return redirect()->route('TeachersList');
})->name('Admin');

});

// Học Sinh
Route::group(['prefix'=>'/', 'middleware' => ['hocsinh']],function(){
    Route::get('/AddClassStudent', function () {
        return view('Student/JoinClass');
    })->name('AddClassStudent');
    Route::get('/showClassStudent',[StudentController::class,'showClassStudent'])->name('showClassStudent')->middleware('auth');
    Route::post('Student/AddClass',[StudentController::class,'addClassStudent'])->name('addClassStudent');
    //<-                Account                 ->

});
Route::get('/loadAccount',[AccountController::class,'loadAccount'])->name('loadAccount');
Route::post('/updateAccount',[AccountController::class,'updateAccount'])->name('updateAccount');
});
//Bạch
Route::get('/', function () {
    return view('/Wellcome');
})->name('Wellcome')->middleware('logout');

// Route::get('/Login', [DangNhapController::class,'dangNhap'])->name('Login')->middleware('logout');
Route::get('/login', [DangNhapController::class,'dangNhap'])->name('login')->middleware('logout');
Route::post('/login', [DangNhapController::class,'xuLyDangNhap'])->name('xl-dang-nhap')->middleware('logout');
// Route::post('/Login', [DangNhapController::class,'xuLyDangNhap'])->name('xl-dang-nhap')->middleware('logout');

Route::get('/ForgotPassword', [DangNhapController::class,'forgotPassword'])->name('ForgotPassword')->middleware('logout');
Route::post('/ForgotPassword', [DangNhapController::class,'xuLyMatKhau'])->name('xl-mat-khau')->middleware('logout');

Route::get('/Password/{id}', [DangNhapController::class,'Password'])->name('Password')->middleware('logout');
Route::post('/Password/{id}', [DangNhapController::class,'taoMoiMatKhau'])->name('mat-khau-moi')->middleware('logout');

Route::get('/Create', [DangNhapController::class,'taoTaiKhoan'])->name('Create')->middleware('logout');
Route::post('/Create', [DangNhapController::class,'xlTaoTaiKhoan'])->name('xl-tao-tai-khoan')->middleware('logout');

Route::get('/dangXuat', [DangNhapController::class,'dangXuat'])->name('dangXuat');
Route::get('/Logout', [DangNhapController::class,'dangXuat'])->name('Logout');
Route::get('/loadAccount',[AccountController::class,'loadAccount'])->name('loadAccount')->middleware('auth');
Route::post('/updateAccount',[AccountController::class,'updateAccount'])->name('updateAccount')->middleware('auth');

Route::get('/Student/Waiting', [StudentController::class, 'listClassWaiting'])->name('classWaiting');

Route::get('/TestRoute', [ClassroomController::class, 'sendMail'])->name("TestRoute");

Route::get('/SendMail', [ClassroomController::class, 'sendMail'])->name("SendMailG");



Route::get('/test', [ClassroomController::class, 'ListHomeWork'])->name("ListHomeWork");