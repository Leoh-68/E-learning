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
     $id=$var->malop;   
    @endphp
  
      <a class="linkname" style="text-decoration: none" href="Class/{{$id}}">
        <h1 class="classname">{{$var->name}}</h1>
      <a>
    <h2 class="nameteacher">
      {{$var->idaccount}}
   
    </h2>
   
    <span class="classcode">
     Mã lớp: {{$var->malop}}
    </span>
    
     <img src="{{ asset('images/3.jpg') }}" class="avatar" align="right">
    <div class="listfunct">
      <a href="{{route('updateSingleClassPost',['id' => $var->malop])}}">admin</a>
      <a  onclick="return confirm('Are you sure?')" href="/deleteClass/{{$var->malop}}">Xóa</a>
    </div>
   </div> 
</div>
@endif
@endforeach
@endsection