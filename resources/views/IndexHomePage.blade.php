
<!DOCTYPE html>
<html lang="en">
@yield('html')
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    {{-- JavaScript --}}
    <script src="{{ asset('js/js.js') }}" ></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    {{-- Fontware --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous"> --}}
    @yield('library')
    <title>E-Learning</title>
</head>
<body>
    <header class="fixed-top">
            <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            @yield('MenuHomePage')
            <a href="{{route('dangXuat')}}">Đăng xuất</a>
         </div>
          <span onclick="openNav()"><i class="fas fa-stream fa-2x"></i></span>
        <a href="#" class="logo">E-Learning Project</a>
        <ul>
        @php
	    $message = Session::get('message');
	    if($message){
		    echo '<span class="alert alert-danger">'.$message.'
            <button type="button" class="close" data-dismiss="alert">x</button>
            </span>';
		    Session::put('message',null);
	    }
	    @endphp
            @yield('AddButton')

            {{Auth::user()->hoten;}}
            @php
                $account=Auth::user()->hinhanh;
            @endphp
            <li>
                <a href="{{route('loadAccount')}}"><img src="{{ asset('images/'.$account) }}" alt="Avatar" class="avatarnavbar"></a>
            </li>

             <li>

            </li>
        </ul>
    </header>
    <div class="">
        @yield('body')
    </div>
</body>

</html>
