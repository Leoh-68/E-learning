@extends('IndexHomePage')
@section('MenuHomePage')
<a href="{{route('showClassStudent')}}">Lớp học</a>
@endsection

@section('body')
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
    <div class="classbody">
        <div class="container">
            <a href="">Quay lại</a>
            <form method="POST" action="">
            @csrf
            </form>
            <table class="table">
            <thead>
                <tr>
                    <th>Giáo viên</th>
                    <th>Tên lớp </th>
                    <th>Mã lớp</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lstStudent as $item)
                <tr>
                    <td>{{App\Http\Controllers\ClassroomController::TheoAccount( $item->id)}}</td>
                    <td> {{ $item->name }}</td>
                    <td>{{ $item->malop}}</td>
                    <td>
                    <a  onclick="return confirm('Bạn có chắc muốn xóa ?')" href="">Xóa</a>
                    <a  href="" >Chấp nhận</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
      </div>

@endsection
