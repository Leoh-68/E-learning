@extends('layouts.AdminPage')
 @section('library')
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>{{ config('app.name', 'Thêm admin') }}</title>
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
 <form action="{{route('xlThemAd')}}" method="POST">
 @csrf
    <div class="">
        <div class="container">
        <a class="btn btn-primary" href="{{route('AdminsList')}}"><i class="fa fa-arrow-alt-circle-left"></i> Quay lại</a>
            <div>
                <br>
                <div>
                    <div class="input">
                        <label>Username</label><span id="font"> *</span>
                        <br>
                        <input type="text" name="username"/>
                        @error('username')
                        <br>
                        <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fixedbox">
                        <label>Password</label><span id="font"> *</span>
                        <br>
                        <input type="password" name="password"/>
                        @error('password')
                        <br>
                        <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div class="input">
                        <label>Họ tên</label><span id="font"> *</span>
                        <br>
                        <input type="text" name="hoten"/>
                        @error('hoten')
                        <br>
                        <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fixedbox">
                        <label>Ngày sinh</label><span id="font"> *</span>
                        <br>
                        <input type="date" name="ngaysinh"/>
                        @error('ngaysinh')
                        <br>
                        <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div class="input">
                        <label>Địa chỉ</label>
                        <br>
                        <input type="text" name="diachi"/>
                        @error('diachi')
                        <br>
                        <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="input">
                        <label>Số điện thoại</label><span id="font"> *</span>
                        <br>
                        <input type="text" name="sdt"/>
                        @error('sdt')
                        <br>
                        <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fixedbox">
                        <label>Email</label><span id="font"> *</span>
                        <br>
                        <input type="email" name="email"/>
                        @error('email')
                        <br>
                        <span id="font">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <button class="btn btn-primary" type = "submit">Thêm <i class="fa fa-check"></i></button>
                    @if (session()->has('unique'))
                    <div style="color:red">
                        {{ session()->get('unique') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
 @endsection
 

