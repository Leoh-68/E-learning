<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Repsponse;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function loadAccount(Request $request)
    {
        $username = session('username');
        $password = session('password');
        $account = Account::where('username', $username)->first();
        return View('Account', compact('account'));
    }
    public function dsLopJoined()
    {
    }
    public function updateAccount(Request $request)
    {
        $request->validate([
            'hoten' => 'required',
            'diachi' => 'required|',
            'ngaysinh' => 'required|',
            'sdt' => 'required|max:10|min:10',
            'email' => 'required|email'
        ], [
            'hoten.required' => 'Vui lòng nhập đầy đủ thông tin',
            'diachi.required' => 'Vui lòng nhập đầy đủ thông tin',
            'ngaysinh.required' => 'Vui lòng nhập đầy đủ thông tin',
            'sdt.required' => 'Vui lòng nhập đầy đủ thông tin',
            'sdt.max' => 'Số điện thoại phải có :max số',
            'sdt.min' => 'Số điện thoại phải có :min số',
            'email.required' => 'Vui lòng nhập đầy đủ thông tin',
        ]);
        $account1 = Account::where('username', session('username'))->first();
        $account = Account::where('id', $account1->id)->first();
        $account->hoten = $request->hoten;
        $account->ngaysinh = $request->ngaysinh;
        $account->diachi = $request->diachi;
        $account->sdt = $request->sdt;
        $account->email = $request->email;
        if ($request->image != null) {
            $size = $request->image->getSize();
            if ($size > 2000000) {
                session()->flash('fail', 'Kích thướt ảnh phải dưới 2M');
                return redirect()->back();
            }
            $extention = $request->image->extension();
            if (
                $extention == "jpg" ||
                $extention == "jpeg" ||
                $extention == "gif" ||
                $extention == "tiff" ||
                $extention == "psd" ||
                $extention == "png" ||
                $extention == "jfif" ||
                $extention == "jpg"
            ) {
                $image = $request->image;
                $image_name = $image->getClientoriginalName();
                $image->move(public_path('images'), $image_name);
                $account->hinhanh = $image_name;
            } else {
                session()->flash('fail', 'Tệp được chọn phải là hình ảnh');
                return redirect()->back();
            }
        }
        $account->save();
        session()->flash('success', 'Sửa thành công');
        return redirect()->route('loadAccount');
    }
    public static function AccountLogin()
    {
        $account = Account::where('username', session('username'))->first();
        return $account;
    }
}
