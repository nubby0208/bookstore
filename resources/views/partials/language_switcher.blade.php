<li class="nav-item px-2">
    <a class="nav-link dropdown-toggle active" href="#" data-toggle="dropdown">
            {{$current_locale}}
    </a>
    <div class="dropdown-menu" style="margin-left: 65%;">
        @foreach($available_locales as $locale_name => $available_locale)
            <a class="dropdown-item" href="language/{{ $available_locale }}">
                {{ $locale_name }}
            </a>
        @endforeach
    </div>
</li>
