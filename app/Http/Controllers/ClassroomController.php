<?php

namespace App\Http\Controllers;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
  public function Classroom(){
      return view('Class');
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
}
