@extends('IndexHomePage')
@section('body')
    @php

    @endphp
    
    <form method="POST" action="{{route('updateAccount')}}">
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
            <input type="text" class="form-control"  value="{{$account->email}}" placeholder="Enter class name" name="email">
            @error('email')
            <span style="color: red">{{$message}}</span>
        @enderror
          </div>

        <button type="submit" class="btn btn-primary" style="margin: 20px 0px 0px">Sửa</button>
      </form>   

@endsection