@extends('IndexHomePage')
@section('MenuHomePage')

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
            <table class="table">
            <thead>
                <tr>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lstStudent as $item)
                <tr>
                    <td>{{ $item->hoten }}</td>
                    <td> {{ $item->ngaysinh }}</td>
                    <td>{{ $item->diachi}}</td>
                    <td>{{ $item->sdt }}</td>
                    <td>{{ $item->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
      </div>

@endsection
