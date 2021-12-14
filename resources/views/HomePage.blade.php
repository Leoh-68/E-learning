@php
use App\Http\Controllers\ClassroomController;   
@endphp
@extends('IndexHomePage')
@section('body')
@foreach ($classlst as $var)
<div class="row">
  <div class="column">
    <div class="card" style="background-image: url('../images/bg.jpg')"> 
      <a style="text-decoration: none" href="/#"><h1 class="classname">{{$var->name}}</h1><a>
      <h2 class="nameteacher">
        {{-- {{$var->username}} --}}
        Mr.Khánh
      </h2>
      <img src="{{ asset('images/3.jpg') }}" class="avatar" align="right"> 
     </div>
  </div>
</div>
@endforeach
@endsection




{{-- @php
for ($i=0; $i <7 ; $i++) { 
@endphp
<div class="row">
   <div class="column">
     <div class="card" style="background-image: url('../images/bg.jpg')"> 
       <a style="text-decoration: none" href="/#"><h1 class="classname">Gacha</h1><a>
       <h2 class="nameteacher">Mr.Khánh</h2>
       <img src="{{ asset('images/3.jpg') }}" class="avatar" align="right"> 
      </div>
   </div>
 </div>
   @php
}    
@endphp --}}