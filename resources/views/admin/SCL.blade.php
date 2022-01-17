@php 
use \App\Http\Controllers\ClassroomController;
@endphp
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
            <a class="btn btn-primary" href="{{route('ClassroomsList')}}"><i class="fa fa-arrow-alt-circle-left"></i> Quay lại</a>
            <br>
            <form method="POST" action="{{route('xlThemSVTL',['id' => request()->id])}}">
            @csrf<input style="width:250px" name="textinput">
                <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Thêm</button>
                <br>
            </form>
            <table class="table">
            <thead>
                <tr>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Đợi xác nhận</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lstStudent as $item)
                <tr>
                    <td>{{ $item->hoten }}</td>
                    <td>{{ $item->ngaysinh }}</td>
                    <td>{{ $item->diachi}}</td>
                    <td>{{ $item->sdt }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ ClassroomController::TheoIdAccount($item->id,request()->id) }}</td>
                    <td>
                    <a class="btn btn-danger" onclick="return confirm('Bạn có chắc không?')" href="{{route('xlXoaSVTL',['id'=>$item->id,'code'=>request()->id])}}"><i class="fa fa-trash"></i> Xóa</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
      </div>
 @endsection