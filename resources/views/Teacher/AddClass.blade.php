@php
    use App\Http\Controllers\ClassroomController;
@endphp
 @extends('IndexHomePage')
 @section('MenuHomePage')
<a href="{{route('showClass')}}">Lớp học</a>
<a href="{{route('Logout')}}">Sủi</a>
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
 @endsection
 @section('html')
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 @endsection
 @section('body')
 <form method="POST" action="{{route('addClass')}}" enctype="multipart/form-data">
  @csrf
  <div class="formsubmit" style="padding: 30px">
  <div class="form-group">
    <label for="">Tên lớp</label>
    <input type="text" class="form-control"  placeholder="Enter class name" name="classname" >
    @error('classname')
        <span style="color: red">{{$message}}</span>
    @enderror
  </div>
  <div class="form-group">
      <label for="">Mã lớp</label>
      <input type="text" class="form-control"  value="{{ClassroomController::randomCode()}}"  placeholder="Enter class code" name="classcode">
      @error('classcode')
      <span style="color: red">{{$message}}</span>
      @enderror
  </div>
  <div class="form-group">
    <label for="">Hình ảnh</label>
    <input type="file" class="form-control"  name="image">
    @error('classcode')
    <span style="color: red">{{$message}}</span>
    @enderror
</div>
  <button type="submit" class="btn btn-primary" style="margin: 20px 0px 0px">Submit</button>
</form>
</div>
@endsection
