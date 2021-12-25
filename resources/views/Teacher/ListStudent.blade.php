@extends('IndexHomePage')
@section('body')
    <div class="classbody">
        <div class="container">
            <a href="">Quay lại</a>
            <form method="POST" action="{{route('dsSinhVienPost',['id' => request()->id])}}">
            @csrf
                <br><input name="textinput">
                <button type="submit"> Thêm</button>
                <span style="color: red">{{Cookie::get('error')}}</span>
            </form>
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
                    <td>{{ $item->diachi}}</td>
                    <td>{{ $item->sdt }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                    <a  onclick="return confirm('Bạn có chắc muốn xóa ?')" href="{{route('xoaSinhvien',['id'=>$item->id,'code'=>request()->id])}}">Xóa</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
      </div>
   
@endsection