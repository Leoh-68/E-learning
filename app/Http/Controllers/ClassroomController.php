<?php

namespace App\Http\Controllers;
use App\Models\Classroom;
use Illuminate\Http\Request;

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
    $class=new Classroom;
    $class->username=1;
    $class->name=$req->classname;
    $class->save();
    return redirect()->route('showClass');
  }
  public function showSingleClass(Request $req){
    $class=Classroom::where('name','=',$req->id)->get();
    return View('Class',compact('class'));
  }
  public function updateClass(Request $req){
  //   $class=new Classroom;
  //   $class=Classroom::where('name','=',$req->id)->get();
  //   foreach($class as $item)
  //   {
  //     $item->name=$req->classname;
  //   }
  // //   $class->name=$req->classname;
  //   $class->save();
  //  return redirect()->route('showClass');
  echo $req->id;
  echo $req->classname;
    
  }
}
