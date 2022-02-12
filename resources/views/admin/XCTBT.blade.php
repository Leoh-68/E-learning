@php 
use \App\Http\Controllers\PostController;

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
            <a class="btn btn-primary" href="{{route('loadBaiTap',['id'=>request()->id1])}}"><i class="fa fa-arrow-alt-circle-left"></i> Quay lại</a>
            <br>
            <div>
                <h1>{{$post->ten}}</h1>
                ------------------------------------------
                <div style="height:250px">
                    <h3 style="white-space:pre-line">
                        {{$post->mota}}
                    </h3>
                </div>
                ------------------------------------------
                <br>@php
                if (PostController::attachmentfromID($post->id)==null) {
                    $image = "";
                } else {
                    $image = asset('images/PostFile/'.PostController::attachmentfromID($post->id));
                }
                @endphp
                <img style="height:150px" src="{{$image}}">
            </div>
        </div>
      </div>
 @endsection