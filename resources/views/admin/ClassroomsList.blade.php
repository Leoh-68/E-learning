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
    <table class="table">
        <thead>
            <tr>
                <th>Tên lớp</th>
                <th>Giảng viên</th>
                <th>Mã lớp</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lst as $Lop)
            <tr>
                <td>{{ $Lop->name }}</td>
                <td>{{ ClassroomController::TheoAccount($Lop->id) }}</td>
                <td>{{ $Lop->malop }}</td>
                <td style="width: 596px;"><a class="btn btn-primary" href="{{route('loadDSSV',['id'=>$Lop->id])}}"><i class="fa fa-pencil-alt"></i> Danh sách sinh viên</a>
                <a class="btn btn-primary" href="{{route('loadBaiGiang',['id'=>$Lop->id])}}"><i class="fa fa-book-open"></i >Danh sách bài giảng</a>
                <a class="btn btn-primary" href="{{route('loadBaiTap',['id'=>$Lop->id])}}"><i class="fa fa-file"></i> Danh sách bài tập</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>
 @endsection
 

