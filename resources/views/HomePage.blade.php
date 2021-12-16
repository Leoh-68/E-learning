@php
use App\Http\Controllers\ClassroomController;   
@endphp
@extends('IndexHomePage')
@section('body')
@foreach ($classlst as $var)
@if ($var->deleted_at==null)
<div class="column">
  <div class="card" style="background-image: url('../images/bg.jpg')"> 
    @php
     $id=$var->name;   
    @endphp
      <a class="linkname" style="text-decoration: none" href="Class/{{$id}}">
        <h1 class="classname">{{$var->name}}</h1>
      <a>
    <h2 class="nameteacher">
      {{-- {{$var->username}} --}}
      Mr.Khánh
    </h2>
    <img src="{{ asset('images/3.jpg') }}" class="avatar" align="right"> 
    <div class="listfunct">
      <a href="/UpdateClassView/{{$var->name}}">Sửa</a>
      <a href="/deleteClass/{{$var->name}}">Xóa</a>
    </div>
   </div>
</div>
@endif
@endforeach
@endsection
