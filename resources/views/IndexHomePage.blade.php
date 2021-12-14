
@import url('https://fonts.googleapis.com/css?family=Nunito');
@import '~bootstrap/scss/bootstrap';
<!DOCTYPE html>
<html lang="en">
@yield('html')
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    {{-- JavaScript --}}
    <script src="{{ asset('js/js.js') }}" ></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    {{-- Fontware --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    @yield('library')
    <title>E-Learning</title>
</head>
<body>
    <header>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="{{route('HomePage')}}">Lớp học</a>
            <a href="#">Việc cần làm</a>
         </div>
          <span onclick="openNav()"><i class="fas fa-stream fa-2x"></i></span>
        <a href="#" class="logo">E-Learning Project</a>
        <ul>
            <li><a href="{{route('Addclass')}}"> <i class="fa fa-plus fa-2x" ></i> </a></li>
            <li>
                 <img src="{{ asset('images/3.jpg') }}" alt="Avatar" class="avatarnavbar">
            </li>
        </ul>
    </header>
     <section class="banner">
     </section>
     @yield('body')
</body>

</html>