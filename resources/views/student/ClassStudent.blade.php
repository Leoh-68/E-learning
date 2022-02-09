


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
 @php
 $hinhanh=App\Http\Controllers\ClassroomController::LayHinhTheoMa($item->idaccount);
 @endphp
 <div class="classbody">
    <div class="imgclass" style="background-image: url('../images/Classroom/{{$item->hinhanh}}')">
        <h1 class="nameinclass">{{$item->name}}</h1>
    </div>
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
    <div class="post">
        @foreach ($post as $var)
        <div class="posts">
            @if ($var->posttype==1)
            <div class="postown">
                <div class="imgpost">
                    <a  href="{{route('ViewPostStudent',['id'=>$var->id])}}"><img src="{{ asset('images/baitap.jpg') }}"
                            alt="Avatar" class="avatarnavbar"></a>
                </div>
                <a href="{{route('ViewPostStudent',['id'=>$var->id])}}" >  <Span>
                    {{ App\Http\Controllers\ClassroomController::TheoAccount($var->idclassroom)}} Đã đăng một bài tập mới: {{$var->ten}}</Span><br>
                <Span style="font-size: 13px; color:grey">{{ $var->created_at->format('d/m/Y') }}</Span></a>

            </div>
            @endif
            @if ($var->posttype!=1)
            <div class="postown">
                <div class="imgpost">
                    <a href="{{ route('loadAccount') }}"><img src="{{ asset('images/'.$hinhanh) }}"
                            alt="Avatar" class="avatarnavbar"></a>
                </div>
                <Span>
                    {{ App\Http\Controllers\ClassroomController::TheoAccount($var->idclassroom) }}</Span><br>
                <Span style="font-size: 13px; color:grey">{{ $var->created_at->format('d/m/Y') }}</Span>

            </div>
            <br>
            <div class="postcontent">
                <a href="{{route('ViewPostStudent',['id'=>$var->id])}}"><label style="color: black">{{ $var->mota }}</label><br></a>
                @php
                    if (App\Http\Controllers\PostController::attachmentfromID($var->id) == null) {
                    } else {
                        $image = App\Http\Controllers\PostController::attachmentfromID($var->id);
                @endphp
                <a href="{{route('ViewPostStudent',['id'=>$var->id])}}"><img style="height:100px " src="{{ asset('/images/PostFile/' . $image) }}"></a>
                @php
                    }
                @endphp
            </div>
            @endif
        </div>
    @endforeach
</div>
    </div>

    <div class="idclass">
        <span class="idcls">Mã lớp</span>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-ellipsis-v"></i></button>
            <div id="myDropdown" class="dropdown-content">

            </div>
          </div>
         <br> <h5 style="padding: 10px">{{$item->malop}}<h5>
    </div>
 @endforeach
    </div>
    </div>
</div>

 @endsection



