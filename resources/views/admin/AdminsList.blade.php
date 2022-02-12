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
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 {{-- link --}}
 
 @endsection
 @section('html')
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 @endsection
 @section('func')
 <div class="">
    <div class="container">
        <a class="btn btn-primary" href="{{route('loadThemAd')}}"><i class="fa fa-plus"></i> Thêm</a>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dsAD as $Admin)
            <tr>
                <td>{{ $Admin->username }}</td>
                <td>{{ $Admin->hoten }}</td>
                <td>{{ $Admin->ngaysinh }}</td>
                <td>{{ $Admin->diachi }}</td>
                <td>{{ $Admin->sdt }}</td>
                <td>{{ $Admin->email }}</td>
                <td><a class="btn btn-primary" href="{{route('loadSuaAd',['id' => $Admin->id])}}"><i class="fa fa-edit"></i> Sửa</a>
                <a class="btn btn-danger" onclick="return confirm('Bạn có chắc không?')" href="{{route('xoaAd',['id' => $Admin->id])}}"><i class="fa fa-trash"></i> Xóa</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>
 @endsection
 

