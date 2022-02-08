<!-- @php
use app\Http\Controllers\ClassroomController;
@endphp -->
@extends('IndexHomePage')
@section('AddButton')
<li><a href="{{route('Addclass')}}"> <i class="fa fa-plus fa-2x" ></i> </a></li>
@endsection
@section('MenuHomePage')
<a href="{{route('showClass')}}">Lớp học</a>

@endsection

@section('logo')
<a href="#" class="logo">E-Learning Project</a>
@endsection
@section('body')
@if(session()->has('success'))
<div class="shadow mx-auto d-block alert alert-success" style="width: 500px">
  {{ session()->get('success') }}
</div>
@endif
@if(session()->has('fail'))
<div class="shadow mx-auto d-block alert alert-danger" style="width: 500px">
  {{ session()->get('fail') }}
</div>
@endif
@foreach ($classlst as $var)
@if ($var->deleted_at==null)
<div class="column">
  <div class="card" style="background-image: url('../images/Classroom/{{$var->hinhanh}}')">
    @php
     $id=$var->malop;
    @endphp
      <a class="linkname" style="text-decoration: none" href="{{route('showSingleClass',['id'=>$id])}}">
        <h1 class="classname">{{$var->name}}</h1>
      <a>
    <h2 class="nameteacher">
      {{\App\Http\Controllers\ClassroomController::TheoAccount($var->id)}}
    </h2>
    @php
        $hinhanh=App\Http\Controllers\ClassroomController::LayHinhTheoMa($var->idaccount);
    @endphp
    <span class="classcode">
     Mã lớp: {{$var->malop}}
    </span>
     <img src="{{ asset('images/'.$hinhanh) }}" class="avatar" align="right">
    <div class="listfunct">
      <a href="{{route('updateSingleClassPost',['id' => $var->malop])}}">Sửa</a>
      <a  onclick="return confirm('Bạn có chắc muốn xóa ?')" href="{{route('deleteClassPost',['id' => $var->malop])}}">Xóa</a>
    </div>
   </div>
</div>
@endif
@endforeach
@endsection
