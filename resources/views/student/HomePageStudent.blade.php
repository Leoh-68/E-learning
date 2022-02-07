<!-- @php
    use app\Http\Controllers\ClassroomController;
@endphp -->
{{--  --}}
@extends('IndexHomePage')
{{--  --}}
@section('AddButton')
    <li><a href="{{ route('AddClassStudent') }}"> <i class="fa fa-plus fa-2x"></i> </a></li>
@endsection
{{--  --}}
@section('logo')
    <a href="#" class="logo">E-Learning Project</a>
@endsection
{{--  --}}
@section('MenuHomePage')
    <a href="{{ route('showClassStudent') }}">Lớp học</a>
    <a href="{{ route('classWaiting') }}">Phòng chờ</a>
@endsection
@section('body')
    @if (session()->has('success'))
        <div class="alert alert-success" style="width: 500px">
            {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('fail'))
        <div class="alert alert-danger" style="width: 500px">
            {{ session()->get('fail') }}
        </div>
    @endif
    @foreach ($classlst as $var)
        @if ($var->deleted_at == null)
            <div class="column">
                <div class="card" style="background-image: url('../images/Classroom/{{ $var->hinhanh }}')">
                    @php
                        $id = $var->malop;
                    @endphp
                    @php
                        $hinhanh = App\Http\Controllers\ClassroomController::LayHinhTheoMa($var->idaccount);
                    @endphp
                    <a class="linkname" style="text-decoration: none"
                        href="{{ route('showSingleClassStudent', ['id' => $id]) }}">
                        <h1 class="classname">{{ $var->name }}</h1>
                        <a>
                            <h2 class="nameteacher">
                                {{ \App\Http\Controllers\ClassroomController::TheoAccount($var->id) }}
                            </h2>
                            <span class="classcode">
                                Mã lớp: {{ $var->malop }}
                            </span>
                            <img src="{{ asset('images/'.$hinhanh) }}" class="avatar" align="right">
                </div>
            </div>
        @endif
    @endforeach
@endsection
