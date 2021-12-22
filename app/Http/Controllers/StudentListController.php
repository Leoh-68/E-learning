<?php

namespace App\Http\Controllers;
use App\Models\StudentList;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class StudentListController extends Controller
{
    public function AddStudent(Request $req)
    {
     
           $studentlis= new StudentList;
           $allacc=Account::where('email',$req->textinput)->first();
           if($allacc==null)
           {
               return 0;
           } 
           $studentlis->stt=1;
           $studentlis->idaccount=$allacc->id;
           $studentlis->idclassroom=$req->id;
           $studentlis->save();
           return redirect()->route('lstStudent',['id'=>$req->id]);
    }

    public function DeleteStudent(Request $req)
    {
        $a= StudentList::where('idaccount',$req->id)->delete();
    
        return redirect()->route('lstStudent',['id'=>$req->code]);
    }
    
}
