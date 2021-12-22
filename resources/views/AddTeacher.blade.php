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
 <form action="{{route('xlThemGV')}}" method="POST">
 @csrf
    <div class="classbody">
        <div class="container">
            <a href="{{route('TeachersList')}}">Quay lại</a>
            <table>
                <tr>
                    <th>Username</th>
                    <td><input type="text" name="username"required/></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input type="text" name="password"required/></td>
                </tr>
                <tr>
                    <th>Họ tên</th>
                    <td><input type="text" name="hoten"required/></td>
                </tr>
                <tr>
                    <th>Ngày sinh</th>
                    <td><input type="date" name="ngaysinh"required/></td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td><input type="text" name="diachi"required/></td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td><input type="text" name="sdt"required/></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email"required/></td>
                </tr>
                <tr>
                    <th></th>
                    <td><button type = "submit">Thêm</button></td>
                </tr>
            </table>
        </div>
    </div>
</form>
 @endsection
 

