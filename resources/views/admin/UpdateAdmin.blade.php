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
 <form action="{{route('xlSuaAd',['id' => $dsAD->id])}}" method="POST" enctype="multipart/form-data">
 @csrf
    <div class="">
        <div class="container">
            <a class="btn btn-primary" href="{{route('AdminsList')}}"><i class="fa fa-arrow-alt-circle-left"></i> Quay lại</a>
            <div>
                <br>
                <div>
                    <div class="input">
                        <label class="font">Username</label>
                        <br>
                        <input type="text" name="username" value="{{$dsAD->username}}"/>
                        <br>
                        @error('username')
                            <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fixedbox">
                        <label>Password</label>
                        <br>
                        <input type="password" name="password" value="{{$dsAD->password}}" />
                        <br>
                        @error('password')
                            <span id="font">{{$message}}</span>
                            @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div class="input">
                        <label>Họ tên</label>
                        <br>
                        <input type="text" name="hoten" value="{{$dsAD->hoten}}" />
                        <br>
                        @error('hoten')
                            <span id="font">{{$message}}</span>
                            @enderror
                    </div>
                    <div class="fixedbox">
                        <label>Ngày sinh</label>
                        <br>
                        <input type="date" name="ngaysinh" value="{{$dsAD->ngaysinh}}" />
                        <br>
                        @error('ngaysinh')
                            <span id="font">{{$message}}</span>
                            @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div class="input">
                        <label>Địa chỉ</label>
                        <br>
                        <input type="text" name="diachi" value="{{$dsAD->diachi}}" />
                    </div>
                    <div class="fixedbox">
                        <label>Số điện thoại</label>
                        <br>
                        <input type="text" name="sdt" value="{{$dsAD->sdt}}" />
                        <br>
                        @error('sdt')
                            <span id="font">{{$message}}</span>
                            @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div class="input">
                        <label>Email</label>
                        <br>
                        <input type="text" name="email" value="{{$dsAD->email}}" />
                        <br>
                        @error('email')
                            <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fixedbox">
                        <label>Hình ảnh</label>
                        <br>
                        <input type="file" name="image">
                        <br>
                    </div>
                </div>
                <br>
                <button class="btn btn-primary" type = "submit">Sửa <i class="fa fa-check"></i></button>
            </div>
        </div>
    </div>
</form>
 @endsection
 

