


 @extends('IndexHomePage')
 @section('library')
 @section('MenuHomePage')
 <a href="{{route('showClassStudent')}}">Lớp học</a>
 @endsection
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>{{ config('app.name', 'Laravel') }}</title>
 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>
 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 {{-- link --}}
 @endsection
 @section('html')
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 @endsection
 @section('body')
 @foreach ($class as $item)
 <div class="classbody">
    <div class="imgclass" style="background-image: url('../images/bg.jpg')">
        <h1 class="nameinclass">{{$item->name}}</h1>
    </div>
    <div class="post">
        <div class="form-group">     
            <textarea type="text" class="posttext"></textarea>
        </div>
   <div class="posts" >
       <div class="imgpost">
        <a href="{{route('loadAccount')}}"><img src="{{ asset('images/3.jpg') }}" alt="Avatar" class="avatarnavbar"></a>
       </div>
       <div class="postown">
        <Span>Trần Phước Khánh</Span><br>
        <Span style="font-size: 13px; color:grey">11/11/2001</Span><br>
       </div>
    <br>
        <div class="postcontent">
              Xin chào cả lớp, sắp tới cô có tổ chức 1 buổi hướng dẫn viết CV, các bạn tham gia để có 1 chiếc CV cho kỳ thực tập sắp tới thật tốt nhé.
              Nội dung buổi chia sẻ:<br>
              - Nắm được những điểm quan trọng trong 1 CV dành cho các bạn lập trình viên<br>
              - Cách xây dựng hình ảnh của mình khi đi ứng tuyển.<br>
              - Được BTC góp ý và chỉnh sửa CV<br>
              - Kết nối doanh nghiệp phù hợp để apply sau khi hoàn tất CV<br>
              Thời gian: 19h30, ngày 31/12/2021<br>
              Hình thức: Online qua Zoom<br>
              Số lượng: 100 slot<br>
              Link đăng ký: https://forms.gle/c1hpn6NPu6kp5g869<br>
              Hạn chót đăng ký: 28/12/2021.<br>
              Thông tin Zoom sẽ được gửi qua email của các bạn, do vậy hãy gõ thật chính xác email của mình nhé.<br>
              Hẹn gặp lại các bạn vào buổi webinar nhé<br>
         </div>
         <div>
            <a href="{{route('loadAccount')}}"><img src="{{ asset('images/3.jpg') }}" alt="Avatar" class="avatarnavbar"></a>
            
         </div>
   </div>
    </div>

    </div>
   
    <div class="idclass">
        <span class="idcls">Mã lớp</span>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn"><i class="fa fa-ellipsis-v"></i></button>
            {{-- <div id="myDropdown" class="dropdown-content">
              <a href="{{route('lstStudent',['id'=>$item->id])}}">Danh sách sinh viên</a>
              
            </div> --}}
          </div>
         <br> <h5 style="padding: 10px">{{$item->malop}}<h5>
    </div>
 @endforeach

    
    </div>
    </div>
</div>

 @endsection
 


