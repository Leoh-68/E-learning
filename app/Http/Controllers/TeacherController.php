<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Http\Requests\SubmitRequest;
use Illuminate\Http\UploadedFile;

class TeacherController extends Controller
{
    public function layDanhSachGV()
    {
        $dsGV = Account::where([['accounttype','=','2'],['deleted_at','=',null]])->get();

        return view('admin/TeachersList',compact('dsGV'));
    }
    public function themGV()
    {
        return view('admin/AddTeacher');
    }
    public function xlThemGV(SubmitRequest $rq)
    {
        $accList = Account::where([['accounttype','=','2'],['deleted_at','=',null]])->get();
        foreach($accList as $var)
           {
               if($var->username == $rq->username)
               {
                session()->flash('unique',"Tài khoản $rq->username đã tồn tại");
                return redirect()->route('loadThemAd');
               }
               else if($var->email == $rq->email){
                session()->flash('unique',"Email $rq->email đã tồn tại");
                return redirect()->route('loadThemAd');
               }
               else if($var->sdt == $rq->sdt){
                session()->flash('unique',"Số điện thoại $rq->email đã tồn tại");
                return redirect()->route('loadThemAd');
               }
           }
        $gv = new Account;
        $gv->username = $rq->username;
        $gv->password = Hash::make($rq->password);
        $gv->hoten = $rq->hoten;
        $gv->ngaysinh = $rq->ngaysinh;
        $gv->diachi = $rq->diachi;
        $gv->sdt = $rq->sdt;
        $gv->email = $rq->email;
        $gv->accounttype = 2;
        $gv->created_at = date("Y-m-d");
        $gv->hinhanh = "default.jpg";
        $gv->save();
        return redirect()->route('TeachersList');
    }
    public function suaGV($id)
    {
        $dsGV = Account::find($id);
        if($dsGV == null||$dsGV->deleted_at != NULL)
        {
            return view('admin/UnknowAccount');
        }
        return view('admin/UpdateTeacher',compact('dsGV'));
    }
    public function xlSuaGV(SubmitRequest $rq,$id)
    {
        $image_name = "";
        if($rq->has('image'))
        {
            $image = $rq->image;
            $image_name=$image->getClientoriginalName();
            $i = explode('.', $image_name);
            $explain =  $rq->id.".".$i[1];
            $image->move(public_path('images'),$explain);
            $gv = Account::find($id);
            $gv->username = $rq->username;
            $gv->password = Hash::make($rq->password);
            $gv->hoten = $rq->hoten;
            $gv->ngaysinh = $rq->ngaysinh;
            $gv->diachi = $rq->diachi;
            $gv->sdt = $rq->sdt;
            $gv->email = $rq->email;
            $gv->accounttype = 2;
            $gv->updated_at = date("Y-m-d");
            $gv->hinhanh = $explain;
            $gv->save();
        }
        $gv = Account::find($id);
        $gv->username = $rq->username;
        $gv->password = Hash::make($rq->password);
        $gv->hoten = $rq->hoten;
        $gv->ngaysinh = $rq->ngaysinh;
        $gv->diachi = $rq->diachi;
        $gv->sdt = $rq->sdt;
        $gv->email = $rq->email;
        $gv->accounttype = 2;
        $gv->updated_at = date("Y-m-d");
        $gv->save();
        return redirect()->route('TeachersList');
    }
    public function xoaGV($id)
    {
        $dsGV = Account::find($id);
        if($dsGV == null||$dsGV->deleted_at != NULL)
        {
            return view('admin/UnknowAccount');
        }
        $dsGV->deleted_at = date("Y-m-d");
        $dsGV->save();
        return redirect()->route('TeachersList');
    }
    
}
