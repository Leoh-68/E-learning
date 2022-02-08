@extends('IndexHomePage')
@section('MenuHomePage')
<a href="{{route('showClass')}}">Lớp học (Giáo viên)</a>
<a href="{{route('showClassStudent')}}">Lớp học (Học sinh)</a>
<a href="{{route('Logout')}}">Sủi</a>
@endsection
@section('body')
@if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('fail'))
                <div class="alert alert-danger" style="width: 500px">
                    {{ session()->get('fail') }}
                </div>
            @endif
    @php
    @endphp
    <form method="POST" action="{{route('updateAccount')}}"  enctype="multipart/form-data">
        @csrf
        <div class="formsubmit" style="padding: 30px">
        <div class="form-group">
            <label for="">Họ tên </label>
            <input type="text" class="form-control"  value="{{$account->hoten}}"  placeholder="Enter class code" name="hoten">
            @error('hoten')
            <span style="color: red">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
          <label for="">Ngày sinh</label>
          <input type="date" class="form-control" value="{{$account->ngaysinh}}"  placeholder="Enter class name" name="ngaysinh">
          @error('ngaysinh')
          <span style="color: red">{{$message}}</span>
      @enderror
        </div>
        <div class="form-group">
            <label for="">Địa chỉ</label>
            <input type="text" class="form-control"  value="{{$account->diachi}}" placeholder="Enter class name" name="diachi">
            @error('diachi')
            <span style="color: red">{{$message}}</span>
        @enderror
          </div>
          <div class="form-group">
            <label for="">Số điện thoại</label>
            <input type="text" class="form-control"  value="{{$account->sdt}}" placeholder="Enter class name" name="sdt">
            @error('sdt')
            <span style="color: red">{{$message}}</span>
        @enderror
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control"  value="{{$account->email}}" placeholder="Enter class name" name="email" readonly>
            @error('email')
            <span style="color: red">{{$message}}</span>
        @enderror
          </div>
          <div class="form-group">
            <label for="">Ảnh đại diện</label>
            <input class="form-control"  type="file" rows="10" name='image'>
            @error('image')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="margin: 20px 0px 0px">Sửa</button>
      </form>

@endsection
