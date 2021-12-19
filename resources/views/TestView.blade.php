<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="{{ asset('js/js.js') }}" ></script>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
</head>
<body>
  <div class="card-deck">
    <div class="cardd">
          <div class="card" style="background-image: url('../images/bg.jpg')"> 
              <a class="linkname" style="text-decoration: none" href="">
                <h1 class="classname">asdadad</h1>
              <a>
            <h2 class="nameteacher">
              {{-- {{$var->username}} --}}
              Mr.Khánh
            </h2>
            <img src="{{ asset('images/3.jpg') }}" class="avatar" align="right"> 
            <div class="listfunct">
              {{-- <a href="{{route('updateClass')}}">Sửa</a> --}}
              <a href="#">Xóa</a>
            </div>
      </div>
    </div>
    <div class="cardd">
  
        <div class="card" style="background-image: url('../images/bg.jpg')"> 
            <a class="linkname" style="text-decoration: none" href="">
              <h1 class="classname">asdadad</h1>
            <a>
          <h2 class="nameteacher">
            {{-- {{$var->username}} --}}
            Mr.Khánh
          </h2>
          <img src="{{ asset('images/3.jpg') }}" class="avatar" align="right"> 
          <div class="listfunct">
            {{-- <a href="{{route('updateClass')}}">Sửa</a> --}}
            <a href="#">Xóa</a>
       
         </div>
    </div>
  </div>

</body>
</html>
