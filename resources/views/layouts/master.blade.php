<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('Books4All') }} - {{ __('Home') }}</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('/')}}assets/img/favicon.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/all.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap4-toggle.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/style.css">
</head>
<body>
<!-- NAVBAR -->
    @include('layouts.includes.navbar')
<!-- NAVBAR END -->
<!-- HEADER -->
<section class="header py-2 blue-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="headings">
                    <h3><a href="{{route('bookshop.home')}}" class="text-secondary"><b style="color: #00cc99;">{{ __('Books') }}</b> <span style="color: white;">{{ __('For All') }}</span></a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{route('all-books')}}">
                    <div class="input-group input-group-sm m-1">
                        <input type="text" name="term" value="{{request('term')}}" class="form-control" placeholder="{{ __('Search Book') }}..">
                        <div class="input-group-append">
                            <button class="btn" style="background-color: #00cc99;" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 row">
                <div class="col-md-4">
                    <!-- <div class="shopping-cart text-right">
                        <a href="{{route('cart')}}" style="color: #00cc99;"><i class="fas fa-shopping-cart fa-2x m-1"></i>
                            @if(Cart::content()->count())
                                <span class="count-cart">{{Cart::content()->count()}}</span>
                            @endif
                        </a>

                    </div> -->
                </div>
                <div class="col-md-4 text-right">
                    <input id="galaxy_checkbox" type="checkbox" checked data-toggle="toggle" data-offstyle="dark" data-onstyle="light" data-on="<i class='fa fa-sun text_white'></i>" data-off="<i class='fa fa-moon text_white'></i>">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HEADER END -->

@yield('content')

<footer class="py-3 text-center border-top bg-light">
    <div class="container">
        <div class="go-to-top mb-2">
            <a href="#nav-top" class="text-muted" title="Go to top"><i class="fas fa-hand-point-up fa-5x"></i></a>
        </div>
        <!-- <div class="footer-text">
            <span id="year"></span>
        </div> -->
        <!-- <div class="social-icon mt-2">
        <span class="mr-2">
          <a href="#" class="text-primary"><i class="fab fa-facebook fa-2x"></i></a>
        </span>
            <span class="mr-2">
          <a href="#" class="text-secondary"><i class="fab fa-github fa-2x"></i></a>
        </span>
            <span class="mr-2">
          <a href="#" class="text-warning"><i class="fab fa-stack-overflow fa-2x"></i></a>
        </span>
        </div> -->
    </div>
</footer>



<!-- jQuery -->
<script type="text/javascript" src="{{asset('/')}}assets/js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('/')}}assets/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('/')}}assets/js/bootstrap.min.js"></script>
<!-- Bootstrap Toggle JavaScript -->
<script type="text/javascript" src="{{asset('/')}}assets/js/bootstrap4-toggle.js"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript" src="{{asset('/')}}assets/js/script.js"></script>

<script type="text/javascript">
    var is_light_mode = true;
    toggleMode();

    $('#galaxy_checkbox').on('change', function() {
        toggleMode();
    });
    
    function toggleMode() {
        if (is_light_mode) {
            $('div.bg-light').removeClass('bg-light').addClass('blue-dark');
            $('.text-black').removeClass('text-black').addClass('text-white');
            $('body').removeClass('blue-dark').addClass('bg-light');
            $('footer').removeClass('blue-dark').addClass('bg-light');
            $('footer').removeClass('text-white').addClass('text-black');
            $('#galaxy_checkbox').prop('checked', true);
            $('.nav-link').removeClass('text-white').addClass('text-black');
        } else {
            $('div.blue-dark').removeClass('blue-dark').addClass('bg-light');
            $('.text-white').removeClass('text-white').addClass('text-black');
            $('body').removeClass('bg-light').addClass('blue-dark');
            $('footer').removeClass('bg-light').addClass('blue-dark');
            $('footer').removeClass('text-black').addClass('text-white');
            $('#galaxy_checkbox').prop('checked', false);
            $('.nav-link').removeClass('text-black').addClass('text-white');
        }
        is_light_mode = !is_light_mode;
    }
</script>

</body>
</html>
