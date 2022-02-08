@php
    use App\Http\Controllers\ClassroomController;
@endphp
 @extends('IndexHomePage')
 @section('MenuHomePage')
<a href="{{route('showClass')}}">Lớp học</a>
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
 <form method="POST" action="{{route('UpdatePostP',['id'=>$post->id,'code'=>request('code')])}}" enctype="multipart/form-data">
  @csrf
  <div class="formsubmit" style="padding: 30px">
  <div class="form-group">
    <label for="">Tên bài đăng</label>
    <input type="text" class="form-control"  value="{{$post->ten}}"  placeholder="Enter class code" name="name">
    @error('name')
        <span style="color: red">{{$message}}</span>
    @enderror
  </div>
  <div class="form-group">
      <label for="">Nội dung</label>
      <textarea class="form-control"  rows="10" name='mota'>{{$post->mota}}</textarea>
      @error('mota')
      <span style="color: red">{{$message}}</span>
  @enderror
  </div>
  <div class="form-group">
    <label for="">Tệp đính kèm</label>
    <input class="form-control"  type="file" rows="10" name='image'>
    @error('image')
    <span style="color: red">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    <label for="exampleFormControlSelect1">Loại bài đăng</label>
    <select class="form-control" name="type" id="type" type="text">
        @php
            if($post->posttype==1)
            {
              echo'<option value="Thông báo">Thông báo</option>';
               echo'<option value="Bài tập" selected="selected">Bài tập</option>';
            }
            else {
              echo'<option value="Thông báo">Thông báo</option>';
              echo '<option value="Bài tập">Bài tập</option>';

            }
        @endphp
    </select>
    @error('type')
    <span style="color: red">{{$message}}</span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary" style="margin: 20px 0px 0px">Submit</button>
</form>
</div>
@endsection

