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
            <table class="table">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô Tả</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lstBaiTap as $item)
                <tr>
                    <td>{{ $item->ten }}</td>
                    <td>{{ $item->mota }}</td>
                    <td>
                    <a class="btn btn-danger" onclick="return confirm('Bạn có chắc không?')" href="{{route('xlXoaSVTL',['id'=>$item->id,'code'=>request()->id])}}"><i class="fa fa-trash"></i> Xóa</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
      </div>
 @endsection