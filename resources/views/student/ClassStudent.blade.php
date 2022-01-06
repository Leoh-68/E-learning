


 @extends('IndexHomePage')
 @section('library')
 @section('MenuHomePage')
 <a href="{{route('showClassStudent')}}">Lớp học</a>
 @endsection
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
            <textarea type="text" class="posttext"></textarea>
        </div>
    </div>
    <div class="idclass">
        <span class="idcls">Mã lớp</span>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-ellipsis-v"></i></button>
            {{-- <div id="myDropdown" class="dropdown-content">
              <a href="{{route('lstStudent',['id'=>$item->id])}}">Danh sách sinh viên</a>
              
            </div> --}}
          </div>
         <br> <h5 style="padding: 10px">{{$item->malop}}<h5>
    </div>
 @endforeach    ~
    </div>
    </div>
</div>

 @endsection
 


