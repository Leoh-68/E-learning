<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <title>E-learning</title>
    <!-- Preloader -->
    <style>
        @keyframes hidePreloader {
            0% {
                width: 100%;
                height: 100%;
            }

            100% {
                width: 0;
                height: 0;
            }
        }

        body>div.preloader {
            position: fixed;
            background: white;
            width: 100%;
            height: 100%;
            z-index: 1071;
            opacity: 0;
            transition: opacity .5s ease;
            overflow: hidden;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.loaded)>div.preloader {
            opacity: 1;
        }

        body:not(.loaded) {
            overflow: hidden;
        }

        body.loaded>div.preloader {
            animation: hidePreloader .5s linear .5s forwards;
        }
    </style>
    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector('body').classList.add('loaded');
            }, 300);
        });
    </script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/E.png') }}" type="image/png"> <!-- logo E trên thanh tag -->
    <!-- Quick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/quick-website.css') }}" id="stylesheet">
</head>

<body>
   
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <!-- <a class="navbar-brand" >
                <img alt="Image placeholder" src="assets/img/brand/dark.svg" id="navbar-logo">
                nơi để logo
            </a> -->
            <!-- Toggler -->
            <strong class="text-primary">E-learning</strong>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Button -->
                <!-- <a class="navbar-btn btn btn-sm btn-primary d-none d-lg-inline-block ml-3" href="https://github.com/webpixels/quick-website-ui-kit-demo/archive/master.zip">
                    Login
                </a> -->
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <section class="slice py-7">
        <div class="container">
            <div class="row row-grid align-items-center">
                <div class="col-12 col-md-5 col-lg-6 order-md-2 text-center">
                    <!-- Image -->
                    <figure class="w-80">
                        <img alt="Image placeholder" src="{{ asset('assets/img/svg/illustrations/illustration-3.svg') }}" class="img-fluid mw-md-120">
                    </figure>
                </div>
                <div class="col-12 col-md-7 col-lg-6 order-md-1 pr-md-5">
                    <!-- Heading -->
                    <h1 class="display-4 text-center text-md-left mb-3">
                        Wellcome to </br> <strong class="text-primary">E-learning</strong>
                    </h1>
                    <!-- Text -->
                    <p class="lead text-center text-md-left text-muted">
                    The more that you read, the more things you will know. The more that you learn, the more places you’ll go.
                    </p>
                    <!-- Buttons -->
                    <div class="text-center text-md-left mt-5">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-icon">
                            <span class="btn-inner--text">Đăng nhập</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</body>
</html>