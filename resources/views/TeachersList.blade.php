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
 <div class="classbody">
    <div class="container">
        <a href="">Quay lại</a>
        <a href="{{route('loadThemGV')}}">Thêm</a>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dsGV as $GiangVien)
            <tr>
                <td>{{ $GiangVien->username }}</td>
                <td>{{ $GiangVien->password }}</td>
                <td>{{ $GiangVien->hoten }}</td>
                <td>{{ $GiangVien->ngaysinh }}</td>
                <td>{{ $GiangVien->diachi }}</td>
                <td>{{ $GiangVien->sdt }}</td>
                <td>{{ $GiangVien->email }}</td>
                <td><a href="{{route('loadSuaGV',['id' => $GiangVien->id])}}">Sửa</a>
                <a href="{{route('xoaGV',['id' => $GiangVien->id])}}">Xóa</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>
 @endsection
 

