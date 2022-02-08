@extends('IndexHomePage')
<!-- @php
use app\Http\Controllers\ClassroomController;
@endphp -->
@section('AddButton')
@endsection
@section('MenuHomePage')
@php
$malop=App\Http\Controllers\ClassroomController::Trans($post->idclassroom);
@endphp
<a href="{{route('showSingleClassStudent',['id'=>$malop])}}"> Trở về</a>
<a href="{{ route('showClassStudent') }}">Lớp học</a>
@endsection
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
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
</div>
@endif
@if (session()->has('fail'))
<div class="alert alert-danger" style="width: 500px">
                    {{ session()->get('fail') }}
</div>
@endif
@php
$account=App\Http\Controllers\AccountController::AccountLogin();
@endphp
@php
$hinhanh=App\Http\Controllers\ClassroomController::LayHinhTheoMa($account->id);
@endphp
<div class="formpost" style="padding-top: 50px">
        <div>
            @if ($post->posttype==1)
            <form method="POST" action="{{route('HomeWorkP',['id'=>$post->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group" style="float: right">
                    <label for="">Tệp đính kèm</label>
                    @if ($att==0)
                    <label style="margin-left:120px;color:red;"> Chưa nộp</label>
                    @else
                    <label style="margin-left:120px;color:green;"> Đã nộp</label>
                    @endif
                    <input type="file" class="form-control"  name="image" style="width: 300px">
                    @error('classcode')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="margin: 30px 0px 0px;float: right;">Nộp</button>
            </form>
            @endif

            <div class="headpostview" style=" border-bottom: 2px solid black; ">
                <h1>
                   {{$post->ten}}
                </h1>
                <h4 style="color: grey">{{$post->created_at->format('d-m-Y')}}</h4>
            </div>
            <div class="contentpostview" style=" border-bottom: 2px solid black;">
                <h4>
                   {{$post->mota}}
                </h4>
                @php
                if (App\Http\Controllers\PostController::attachmentfromID($post->id) == null) {
                } else {
                    $image = App\Http\Controllers\PostController::attachmentfromID($post->id);
            @endphp
            <a href="{{ asset('/images/PostFile/' . $image) }}" download>
                <img style="height:100px " src="{{ asset('/images/PostFile/' . $image) }}">
            </a>
            @php
                }
            @endphp
            </div>
            <form action="{{route('AddComment',['idpost'=>$post->id,'idaccount'=>$account->id])}}">
                <div class="comment">
                    <a href="{{ route('loadAccount') }}"><img src="{{ asset('images/'.$hinhanh) }}" alt="Avatar"
                            class="avatarnavbar"></a>
                    <input placeholder="Bình luận" style="padding-left: 10px" name="comment">
                    @error('comment')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                   <button type="submit" class="btn btn-light"><i class="fa fa-angle-right" style="font-size:24px"></i></button>
                </div>
            </form>
            @foreach ($cmt as $res)
            @php
            $hinhanhcmt=App\Http\Controllers\ClassroomController::LayHinhTheoMa($res->idaccount);
            @endphp
            <div>
                <div style="float: left">
                    <img src="{{ asset('images/'.$hinhanhcmt) }}" alt="Avatar" class="avatarnavbar">
                </div>
                <div style="float: left">
                    <span class="">
                        {{\App\Http\Controllers\CommentController::layTenAccTheoID($res->idaccount)}}
                    </span><br>
                    <span>{{$res->comment}}</span><br>
                </div>
            </div>
            <form action="#">
                <div class="dropdown" style="padding-right: 20px">
                    <button class="btn btn-basic dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"
                            href="{{route('UpdateCommentG',['idcomment'=>$res->id])}}">Sửa</a>
                        <a class="dropdown-item" href="{{route('DeleteCommentP',['idcomment'=>$res->id])}}">Xóa</a>
                    </div>
                </div>
            </form>
            <br>
            <br>
            @endforeach
            </div>

</div>
@endsection

