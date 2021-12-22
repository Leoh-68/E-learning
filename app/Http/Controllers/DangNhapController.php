<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\AccountType;
use App\Http\Requests\DangNhapRequest;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Str;

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
        $rep= new Response();
       
        $user = Account::where('username',$request->username)->first();
       
        //  if(empty($user)){
        //     echo"Tên đăng nhập hoặc mật khẩu không đúng";
        //  }else if($user->password != $request->password){
        //     echo"Tên đăng nhập hoặc mật khẩu không đúng";
        //  }else{
        //      echo $user->hoTen;
        //  }
        // $request->validate([
        //     'username' => 'required',
        //     'password' => 'required|min:5'
        //     ]);  
        $request->validate([
           
        ]);     
         //$validated = $request->validated();
         if (Auth::attempt(['username' =>$request->username, 'password' =>  $request->password])) { 
            $user = Account::where('username',$request->username)->first();
            //----------------------Cookie *Khánh làm
            Cookie::queue('username',$request->username,3600);
            Cookie::queue('password',$request->password,3600);
            //---------------------------

            //--------------------Xét quyền truy cập *Khánh làm
            if($user->accounttype==1)
            {
                return  redirect()->route('showClassAdmin');
            }
            if($user->accounttype==2)
            {
                return  redirect()->route('showClass');
            }
            if($user->accounttype==3)
            {
                return  redirect()->route('showClassStudent');
            }
            //--------------------------
            //$Type = AccountType::where('id',$user->accounttype)->first();
            //$AccType = $Type->type;
           
         }
         else{
            if($user->username != $request->username){
                $userText = " không đúng";
                return view('Login',compact('userText'));   
             }else 
             $pwText = " không đúng";
             return view('Login',compact('pwText'));
         }
            
    }

    public function forgotPassword()
    {
        return view('ForgotPassword');
    }

    public function xuLyMatKhau(EmailRequest $request)
    {
        
        $request->validate([
        ]);    
        $user = Account::where('email',$request->email)->first();
         if(empty($user)||$user->email != $request->email){
            $title = " không đúng";
            return view('ForgotPassword',compact('title'));
         }else{
            $number = Str::random(5);
            $id = $user->id;
            $data = Account::find($id);
            $data->password = Hash::make($number);
            $data->save();
            return view('Login',compact('number'));
         }           
    }

    //MÃ hóa mật khẩu
    public function update()
        {
        $id=1;
        $data = Account::find($id);
        $data->password = Hash::make('123456');
        $data->save();
        echo 'Cập nhật thành viên thành công!';
    }

    //Cái này là đăng xuất
    public function dangXuat()
    {
        Auth::logout();
        return view('Login');
    }

}
