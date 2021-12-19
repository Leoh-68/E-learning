@extends('IndexHomePage')
 @section('library')
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>{{ config('app.name', 'Laravel') }}</title>
 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>
 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 {{-- link --}}
 
 @endsection
 @section('html')
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 @endsection
 @section('body')
 <form action="{{route('xlSuaSV',['id' => $dsSV->id])}}" method="POST">
 @csrf
    <div class="classbody">
        <div class="container">
            <a href="">Quay lại</a>
            <table>
                <tr>
                    <th>Username</th>
                    <td><input type="text" name="username" value="{{$dsSV->username}}" required/></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input type="text" name="password" value="{{$dsSV->password}}" required/></td>
                </tr>
                <tr>
                    <th>Họ tên</th>
                    <td><input type="text" name="hoten" value="{{$dsSV->hoten}}" required/></td>
                </tr>
                <tr>
                    <th>Ngày sinh</th>
                    <td><input type="date" name="ngaysinh" value="{{$dsSV->ngaysinh}}" required/></td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td><input type="text" name="diachi" value="{{$dsSV->diachi}}" required/></td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td><input type="text" name="sdt" value="{{$dsSV->sdt}}" required/></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" value="{{$dsSV->email}}" required/></td>
                </tr>
                <tr>
                    <th></th>
                    <td><button class="btn btn-primary" type = "submit">Sửa</button></td>
                </tr>
            </table>
        </div>
    </div>
</form>
 @endsection
 

