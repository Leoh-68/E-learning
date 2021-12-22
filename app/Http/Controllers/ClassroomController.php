<?php
namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\Account;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Repsponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassroomController extends Controller
{
  public function Classroom(){
      return view('Class');
  }     
  public function getUpdateClass(Request $req){
    $class=Classroom::where('malop','=',$req->id)->get();
    return View('Teacher/UpdateClass',compact('class'));
  }
/*Lớp của giáo viên*/
  public function showClass(){
    $classlst=Classroom::all();
    if($classlst==null)
    {
      return 0;
    }
    return View('Teacher/HomePage',compact('classlst'));
  }
/*Lớp của admin*/
  public function showClassAdmin(){

    $classlst=Classroom::all();
    if($classlst==null)
    {
      return 0;
    }
    return View('admin/HomePageAdmin',compact('classlst'));
  }
/*Lớp của sinh viên*/
  public function showClassStudent(){

    $classlst=Classroom::all();
    if($classlst==null)
    {
      return 0;
    }
    return View('student/HomePageStudent',compact('classlst'));
  }

  public function addClass(Request $req)
  {
    $listClass=Classroom::all();
    foreach($listClass as $var)
    {
  
      if($var->malop==$req->classcode)
      {
        return "Lớp đã tồn tại";
      }
    }
    $account=Account::where('username',Cookie::get('username'))->first();
    $class=new Classroom;
    $class->idaccount=$account->hoten;
    $class->name=$req->classname;
    $class->malop=$req->classcode;
    $class->save();
    return redirect()->route('showClass');
  }

  public function showSingleClass(Request $req){
    $class=Classroom::where('malop','=',$req->id)->get();

    return View('Class',compact('class'));
  }

  public function updateClass(Request $req){
    $req->validate([
      'classname'=>'required',
      'username'=>'required',

    ]);
    $class=Classroom::where('malop','=',$req->id)->first();
    $class->name=$req->classname;
    $class->save();
   return redirect()->route('showClass');
  }
  
  public function deleteClass(Request $req)
  {
    $class=Classroom::where('malop','=',$req->id)->first();
    $class->deleted_at= Carbon::now(); 
    $class->save();
   return redirect()->route('showClass');
  }

  public static function randomCode()
  {
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $class= Classroom::all();
    $code= substr(str_shuffle(str_repeat($pool, 5)), 0, 6);
    foreach($class as $var)
    {
      while($var->malop==$class)
      {
        $code= rand(6);
      }
    }
    return $code;
  }
}
