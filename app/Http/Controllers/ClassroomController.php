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
      if($var->name==$req->classname)
      {
        return "Lớp đã tồn tại";
      }
    }
    $class=new Classroom;
    $class->username=1;
    $class->name=$req->classname;
    $class->idclass="Abc$32";
    $class->save();
    return redirect()->route('showClass');
  }
  public function showSingleClass(Request $req){
    $class=Classroom::where('name','=',$req->id)->get();
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
}
