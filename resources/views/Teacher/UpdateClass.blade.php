
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
 @endsection
 @section('html')
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 @endsection
 @section('body')
 @foreach ($class as $item)
 <form method="POST" action="{{route('updateSingleClassPost',['id' => $item->malop])}}"  enctype="multipart/form-data">
  @csrf
  <div class="formsubmit" style="padding: 30px">

      <div class="form-group">
      <label for="">Tên lớp</label>
      <input type="text" value="{{$item->name}}" class="form-control"  placeholder="Enter class name" name="classname">
    </div>
    <div class="form-group">
      <label for="">Giảng viên</label>
      <input type="subject" value="{{\App\Http\Controllers\ClassroomController::LayTenTheoMa($item->idaccount)}}"  class="form-control"  placeholder="Enter suject name" name="username" readonly>
    </div>
    <div class="form-group">
        <label for="">Hình ảnh</label>
        <input type="file" class="form-control" name="image">
        @error('classcode')
        <span style="color: red">{{$message}}</span>
        @enderror
    </div>
      @endforeach
  <button type="submit" class="btn btn-primary" style="margin: 20px 0px 0px">Submit</button>
</form>
</div>
@endsection
