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
 <form method="POST" action="{{route('CopyPostP',['id'=>$post->id])}}" enctype="multipart/form-data">
  @csrf
  <div class="form-group" style="padding-top: 50px">
    <label for="exampleFormControlSelect1">Lớp học</label>
    <select class="form-control" name="class" id="type" type="text">
        @foreach ($class as  $var)
        @if ($var->deleted_at==null)
        <option value="{{$var->malop}}">{{$var->name}}</option>
        @endif
        @endforeach
    </select>
    @error('type')
    <span style="color: red">{{$message}}</span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary" style="margin: 20px 0px 0px">Submit</button>
</form>
</div>
@endsection

