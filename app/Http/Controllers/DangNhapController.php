<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Account;
use App\Http\Requests\DangNhapRequest;
use App\Http\Requests\EmailRequest;

// Bạch: Ngộ thêm cả thư mục fonts(~E-learning\public\fonts) 
// và vendor(~E-learning\public\vendor) nhưng ghi chú hết thì trầm cảm lắm
class DangNhapController extends Controller
{
    public function dangNhap()
    {
        return view('Login');
    }

    public function messages()
    {
        return [
            'username.required' => 'Chưa nhập tên đăng nhập',
            'password.required' => 'Chưa nhập mật khẩu',
            'password.min'=>'Password chứa ít nhất 5 ký tự',
            'email.required' => 'Chưa nhập email',
            'email.gmail' => 'Định dạng email không đúng',
        ];
    }

    public function xuLyDangNhap(DangNhapRequest $request)
    {
        $user = Account::where('username',$request->username)->first();  
        // $request->validate([
        // ]);     
         $validated = $request->validated();
         if (Auth::attempt(['username' =>$request->username, 'password' =>  $request->password])) { 
            $user = Account::where('username',$request->username)->first();
            if($user->accounttype==2){
            return redirect()->route('showClass',compact('user'));
            }elseif($user->accounttype==1){
               echo ' Admin đăng nhập';
            }
                echo ' Học sinh đăng nhập';
         }else{
             $Text = "Username hoặc password không tồn tại";
             return view('Login',compact('Text'));
         }      
    }

    public function forgotPassword()
    {
        return view('ForgotPassword');
    }

    public function xuLyMatKhau(EmailRequest $request)
    {
        
        $validated = $request->validated();   
        $user = Account::where('email',$request->email)->first();
        if(empty($user)||$user->email != $request->email){
            $title = " Email không tồn tại";
            return view('ForgotPassword',compact('title'));
        }
        Mail::send('SendMail',compact('user'),function($email) use($user){
            $email->subject('E-learning - Quên mật khẩu');
            $email->to($user->email,$user->hoten);
        });           
    }

    public function guiMail($id)
    {
        $user = Account::find($id);
        Mail::send('SendMail',compact('user'),function($email) use($user){
            $email->subject('Forgot Password');
            $email->to($user->email,$user->hoTen);
        });
    }

    public function Password($id)
    {
        $user = Account::find($id);
        return view('Password',compact('user'));
    }

    public function taoMoiMatKhau(Request $request,$id)
    {
        
        $request->validate([
            'password' => 'required|min:5',
            'password2' => 'required|min:5'
        ]
        );  
        $user = Account::find($id);
        if($request->password!=$request->password2){
            $title = " Password không khớp";
            return view('Password',compact('title','user'));
         }else{
            $user->password = Hash::make($request->password);
            $user->save();
            $Text = "Cập nhật thành công";
            return view('Password',compact('Text','user'));
         }           
    }
    

    //Cái này là đăng xuất
    public function dangXuat()
    {
        Auth::logout();
        return redirect()->route('Login');
    }
}
