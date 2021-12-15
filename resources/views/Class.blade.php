

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
 <div class="classbody">
    <div class="imgclass" style="background-image: url('../images/bg.jpg')">
        <h1 class="nameinclass">{{$item->name}}</h1>
    </div>
    <div class="post">
        <div class="form-group">     
            <input type="text" class="posttext">
        </div>
    </div>
    <div class="idclass">
        <span class="idcls">Mã lớp</span>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-ellipsis-v"></i></button>
            <div id="myDropdown" class="dropdown-content">
              <a href="#">Link 1</a>
              <a href="#">Link 2</a>
              <a href="#">Link 3</a>
            </div>
          </div>
          <h5 style="padding: 10px">AadaKNdaw<h5>
    </div>
 @endforeach

            <input type="text" class="status">
            <input type="text" class="status">
            <input type="text" class="status">
            <input type="text" class="status">
            <input type="text" class="status">
            <input type="text" class="status">
            <input type="text" class="status">
            <input type="text" class="status">
            <input type="text" class="status">
            <input type="text" class="status">
       
    </div>
    </div>
</div>

 @endsection
 

