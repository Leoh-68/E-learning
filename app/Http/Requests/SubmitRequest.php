<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'hoten' => 'required',
            'ngaysinh' => 'required',
            'sdt' => 'required|max:10',
            'email' => 'required|email:rfc'
        ];
    }
    public function messages()
    {
        return[
            'username.required' => 'Chưa nhập username',
            'password.required' => 'Chưa nhập password',
            'hoten.required' => 'Chưa nhập họ tên',
            'ngaysinh.required' => 'Chưa nhập ngày sinh',
            'sdt.required' => 'Chưa nhập số điện thoại',
            'sdt.max' => 'Số điện thoại không được quá 10 chữ số',
            'email.required' => 'Chưa nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng mail'
        ];
    }
}
