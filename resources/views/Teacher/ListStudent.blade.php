@extends('IndexHomePage')
@section('MenuHomePage')
    <a href="{{ route('showClass') }}">Lớp học</a>
    <a href="{{ route('showSingleClass', ['id' => request()->id]) }}">Quay lại</a>
@endsection
@if (session()->has('success'))
    <div class="shadow mx-auto d-block alert alert-success" style="width: 500px">
        {{ session()->get('success') }}
    </div>
@endif
@if (session()->has('fail'))
    <div class="shadow mx-auto d-block alert alert-danger" style="width: 500px">
        {{ session()->get('fail') }}
    </div>
@endif
@section('body')
    <div class="classbody">
        <div class="container">
            <div style="float: left; width:50%">
                <form method="POST" action="{{ route('SendMailP', ['id' => request()->id, 'name' => $accountname]) }}">
                    @csrf
                    <br><input name="textinput">
                    <button type="submit" class="btn btn-primary"> Thêm</button>
                    <br>
                    <span style="color: red">{{ Cookie::get('error') }}</span>
                </form>
            </div>

            <!-- <div style="float: right">
                <form method="GET" action="{{ route('FindStudentG', ['id' => $malop]) }}">
                    @csrf
                    <br><input name="name">
                    <button type="submit" class="btn btn-success"> Tìm kiếm</button>
                    <span style="color: red">{{ Cookie::get('error') }}</span>
                </form>
            </div> -->

            <table class="table">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lstStudent as $item)
                        <tr>
                            <td>{{ $item->hoten }}</td>
                            <td> {{ $item->ngaysinh }}</td>
                            <td>{{ $item->diachi }}</td>
                            <td>{{ $item->sdt }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a onclick="return confirm('Bạn có chắc muốn xóa ?')"
                                    href="{{ route('xoaSinhvien', ['id' => $item->id, 'code' => request()->id]) }}">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
