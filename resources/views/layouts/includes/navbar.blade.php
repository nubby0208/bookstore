<nav class="navbar navbar-expand-sm text-white navbar-white p-1" id="nav-top">
    <div class="container">
        <a href="{{route('bookshop.home')}}" class="logo-img"></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-collapse">
            <ul class="navbar-nav ">
                <li class="nav-item px-2 ">
                    <a href="{{route('bookshop.home')}}" class="nav-link">{{ __('Home') }}</a>
                </li>
                <li class="nav-item px-2">
                    <a href="{{route('all-books')}}" class="nav-link">{{ __('Books') }}</a>
                </li>
                <li class="nav-item px-2">
                    <a href="{{route('discount-books')}}" class="nav-link">{{ __('Discount Book') }}</a>
                </li>
                <li class="nav-item px-2">
                    <a href="{{route('about')}}" class="nav-link">{{ __('About') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @include('partials/language_switcher')
                @if(Auth::check() == false)
                    <li class="nav-item px-2">
                        <a href="{{url('login')}}" class="nav-link text-danger"><i class="fas fa-user-lock"></i> {{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('register')}}" class="nav-link"><i class="fas fa-user"></i> {{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">
                            <span class="image-circle"><img src="{{Auth::user()->image? Auth::user()->image_url:Auth::user()->default_img}}" width="30" alt=""></span>
                            {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu">
                            @if(Auth::user()->role->name == "Admin")
                                <a class="dropdown-item" href="{{route('admin.home')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-muted"></i>
                                    {{ __('Profile') }}
                                </a>
                            @elseif(Auth::user()->role->name == "User")
                                <a class="dropdown-item" href="{{route('user.home')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-muted"></i>
                                    {{ __('Profile') }}
                                </a>
                            @else
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-muted"></i>
                                    {{ __('Profile') }}
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{url('logout')}}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-muted"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
