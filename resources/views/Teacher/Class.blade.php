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
    @foreach ($class as $item)
        @php
            $idclass = $item->malop;
        @endphp
        <div class="classbody">
            <div class="imgclass" style="background-image: url('../images/1.jpg')">
                <h1 class="nameinclass">{{ $item->name }}</h1>
            </div>
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
            <div class="post">
                @foreach ($post as $var)
                    <div class="posts">
                        <div class="postown">
                            <div class="imgpost">
                                <a href="{{ route('loadAccount') }}"><img src="{{ asset('images/3.jpg') }}"
                                        alt="Avatar" class="avatarnavbar"></a>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-basic dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                        href="{{ route('UpdatePost', ['id' => $var->id, 'code' => $item->id]) }}">Sửa</a>
                                    <a class="dropdown-item" href="{{ route('DeletePostP', ['id' => $var->id, 'code' => $item->id]) }}">Xóa</a>
                                </div>
                            </div>
                            <Span>
                                {{ App\Http\Controllers\ClassroomController::TheoAccount($var->idclassroom) }}</Span><br>
                            <Span style="font-size: 13px; color:grey">{{ $var->created_at->format('d/m/Y') }}</Span>

                        </div>
                        <br>
                        <div class="postcontent">
                            <a href="{{route('ViewPost',['id'=>$var->id])}}"><label style="color: black">{{ $var->mota }}</label><br></a>
                            @php
                                if (App\Http\Controllers\PostController::attachmentfromID($var->id) == null) {
                                } else {
                                    $image = App\Http\Controllers\PostController::attachmentfromID($var->id);
                            @endphp
                            <a href="{{route('ViewPost',['id'=>$var->id])}}"><img style="height:100px " src="{{ asset('/images/PostFile/' . $image) }}"></a>
                            @php
                                }
                            @endphp
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="idclass">
            <span class="idcls">Mã lớp</span>
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn"><i class="fa fa-ellipsis-v"></i></button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="{{ route('lstStudent', ['id' => $item->malop]) }}">Thành viên</a>
                    <a href="{{ route('lstStudentWating', ['id' => $item->malop]) }}">Phòng chờ</a>
                </div>
            </div>
            <br>
            <h5 style="padding: 10px">{{ $item->malop }}<h5>
        </div>
    @endforeach
@section('AddButton')
    <div class="dropdown">
        <button type="button" style="background-color: white" class="btn btn-light" id="dropdownMenuButton"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <li><a href=""> <i class="fa fa-plus fa-2x"></i> </a></li>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('ShowPost', ['id' => $idclass]) }}">Đăng bài</a>
            <a class="dropdown-item" href="#">Đăng bài tập</a>
        </div>
    </div>
@endsection
@section('MenuHomePage')
    <a href="{{ route('showClass') }}">Lớp học</a>
    <a href="{{ route('ShowPost', ['id' => $idclass]) }}">Đăng bài</a>
    <a href="#">Đăng bài tập</a>
@endsection
<div>
@endsection
