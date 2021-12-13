

<!DOCTYPE html>
<html lang="en">
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

    <title>E-Learning</title>
</head>
<body>
    <header>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#">Lớp học</a>
            <a href="#">Việc cần làm</a>
         </div>
          <span onclick="openNav()"><i class="fas fa-stream fa-2x"></i></span>
        <a href="#" class="logo">E-Learning Project</a>
        <ul>
            <li><a href="#"> <i class="fa fa-plus fa-2x" ></i> </a></li>
            <li>
                 <img src="{{ asset('images/3.jpg') }}" alt="Avatar" class="avatarnavbar">
                 
            </li>
        </ul>
    </header>
     <section class="banner">
     </section>
     
     @php
     for ($i=0; $i <7 ; $i++) { 
    @endphp
    <div class="row">
        <div class="column">
          <div class="card" style="background-image: url('../images/bg.jpg')"> 
            <a style="text-decoration: none" href="/#"><h1 class="classname">Gacha</h1><a>
            <h2 class="nameteacher">Mr.Khánh</h2>
            <img src="{{ asset('images/3.jpg') }}" class="avatar" align="right"> 
           </div>
        </div>
      </div>
        @php
     }    
     @endphp
</body>

</html>
