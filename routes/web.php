<?php
use App\Http\Controllers\ClassroomController;
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

Route::get('/HomePage', function () {
    return view('HomePage');
})->name('HomePage');

Route::get('/AddClass', function () {
    return view('AddClass');
})->name('Addclass');

Route::get('/Class', function () {
    return view('Class');
})->name('Class');

Route::post('/AddClass',[ClassroomController::class,'addClass'])->name('addClass');

Route::get('/',[ClassroomController::class,'showClass'])->name('showClass');

Route::get('/Class/{id}', [ClassroomController::class,'showSingleClass'])->name('showSingleClass');

Route::get('/UpdateClassView/{id}', [ClassroomController::class,'getUpdateClass'])->name('updateSingleClass');

// Route::get('/updateClass/{name}', [ClassroomController::class,'updateClass'])->name('updateClassGet');

Route::post('/updateClass/{id}', [ClassroomController::class,'updateClass'])->name('updateClassPost');    