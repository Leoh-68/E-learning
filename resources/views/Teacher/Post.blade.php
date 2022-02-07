@extends('IndexHomePage')
@section('AddButton')
<div class="dropdown">
    <button type="button"  style="background-color: white" class="btn btn-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <li><a href=""> <i class="fa fa-plus fa-2x" ></i> </a></li>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="#">Đăng bài</a>
      <a class="dropdown-item" href="#">Đăng bài tập</a>
    </div>
  </div>
@endsection
@section('MenuHomePage')
    <a href="{{route('showSingleClass',['id'=>$idclass])}}"> Trở về</a>
    <a href="{{ route('showClass') }}">Lớp học</a>
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
@if(session()->has('success'))
<div class="alert alert-success" style="width: 500px">
  {{ session()->get('success') }}
</div>
@endif
@if(session()->has('fail'))
<div class="alert alert-danger" style="width: 500px">
  {{ session()->get('fail') }}
</div>
@endif
<div class="formpost" style="padding-top: 50px; padding-left: 20px;">
    <form action="{{ route('post', ['id' => $idclass]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label >Tên bài đăng </label>
        <textarea type="text" class="form-control" name="name" required></textarea>
        @error('name')
            <span style="color: red">{{ $message }}</span>
        @enderror
        <label >Nội dung</label>
        <textarea type="text" class="form-control" rows="4" name="post" required></textarea>
        @error('name')
            <span style="color: red">{{ $message }}</span>
        @enderror
        <div class="form-group">
            <label for="exampleFormControlSelect1">Loại bài đăng</label>
            <select class="form-control" name="type" id="type" type="text">
              <option value="Thông báo">Thông báo</option>
              <option value="Bài tập">Bài tập</option>
            </select>
          </div>
            <label>Hình ảnh</label>
            <input style="margin-bottom: 10px" type="file" class="form-control"  name="image">
            <button  type="submit" class="btn btn-secondary">submit</button>

    </form>
</div>
@endsection

