<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
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
        if (Auth::attempt(['username' =>$request->username, 'password' =>  $request->password])) { 
            $user = Account::where('username',$request->username)->first();
            Cookie::queue('username',$request->username,3600);
            Cookie::queue('password',$request->password,3600);
            if($user->accounttype==2){
            return redirect()->route('showClass');
            }elseif($user->accounttype==1){
                return redirect()->route('Admin');
            }
            return  redirect()->route('showClassStudent');
         }else{
             $Text = "Username hoặc password không tồn tại";
             return redirect()->route('Login');
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
        //return redirect()->route('Login');         
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
        return view('Login');
    }

}
