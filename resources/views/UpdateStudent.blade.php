@extends('layouts.AdminPage')
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
 @section('func')
 <form action="{{route('xlSuaSV',['id' => $dsSV->id])}}" method="POST">
 @csrf
    <div class="">
        <div class="container">
            <a class="btn btn-primary" href="{{route('StudentsList')}}"><i class="fa fa-arrow-alt-circle-left"></i> Quay lại</a>
            <br><br>
            <div class="input">
                <label class="font">Username</label>
                <br>
                <input type="text" name="username" value="{{$dsSV->username}}" required/>
            </div>
            <div>
                <label>Password</label>
                <br>
                <input type="text" name="password" value="{{$dsSV->password}}" required/>
            </div>
            <br>
            <div class="input">
                <label>Họ tên</label>
                <br>
                <input type="text" name="hoten" value="{{$dsSV->hoten}}" required/>
            </div>
            <div>
                <label>Ngày sinh</label>
                <br>
                <input type="date" name="ngaysinh" value="{{$dsSV->ngaysinh}}" required/>
            </div>
            <br>
            <div class="input">
                <label>Địa chỉ</label>
                <br>
                <input type="text" name="diachi" value="{{$dsSV->diachi}}" required/>
            </div>
            <div class="input">
                <label>Số điện thoại</label>
                <br>
                <input type="text" name="sdt" value="{{$dsSV->sdt}}" required/>
            </div>
            <div>
                <label>Email</label>
                <br>
                <input type="email" name="email" value="{{$dsSV->email}}" required/>
            </div>
            <br>
            <button class="btn btn-primary" type = "submit">Sửa <i class="fa fa-check"></i></button>
        </div>
    </div>
</form>
 @endsection
 

