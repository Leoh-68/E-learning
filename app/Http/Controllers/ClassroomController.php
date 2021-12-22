<?php

namespace App\Http\Controllers;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassroomController extends Controller
{
  public function Classroom(){
      return view('Class');
  }     
  public function getUpdateClass(Request $req){
    $class=Classroom::where('name','=',$req->id)->get();
    return View('UpdateClass',compact('class'));
  }

  public function showClass(){

    $classlst=Classroom::all();
    if($classlst==null)
    {
      return 0;
    }
    return View('HomePage',compact('classlst'));
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
    $class=new Classroom;
    $class->idaccount=1;
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

    $class=Classroom::where('name','=',$req->id)->first();
    $class->name=$req->classname;
    $class->save();
   return redirect()->route('showClass');
  }
  public function deleteClass(Request $req)
  {
   
    $class=Classroom::where('name','=',$req->id)->first();
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
    echo $code;
    return $code;
  }
}
