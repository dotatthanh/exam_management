<div class="nav__inner">
    <a href="#!" class="logo">
        <!-- <img src="{{ asset('static/assets/icons/heart.svg') }}" alt="" class="logo__img" /> -->
        <img src="{{ asset('static/assets/icons/logo.svg') }}" alt="" class="logo__img">

    </a>

    <!-- Nav 1 -->
    <ul class="nav flex-column nav-1">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <img src="{{ asset('static/assets/icons/film.svg') }}" alt="" class="nav-link__logo" />
                <p>Trang chủ</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <img src="{{ asset('static/assets/icons/heart.svg') }}" alt="" class="nav-link__logo" />
                <p>Yêu thích</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <img src="{{ asset('static/assets/icons/trending.svg') }}" alt="" class="nav-link__logo" />
                <p>Thịnh hành</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <img src="{{ asset('static/assets/icons/calendar.svg') }}" alt="" class="nav-link__logo" />
                <p>Sắp ra mắt</p>
            </a>
        </li>
    </ul>

    <!-- Nav 2 -->
    <ul class="nav flex-column nav-2">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <img src="{{ asset('static/assets/icons/user.svg') }}" alt="" class="nav-link__logo" />
                Community
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <img src="{{ asset('static/assets/icons/message.svg') }}" alt="" class="nav-link__logo" />
                Social
            </a>
        </li>
    </ul>

    <!-- Nav 3 -->
    <ul class="nav flex-column nav-3">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <img src="{{ asset('static/assets/icons/setting.svg') }}" alt="" class="nav-link__logo" />
                Settings
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">
                <img src="{{ asset('static/assets/icons/log-out.svg') }}" alt="" class="nav-link__logo" />
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </li>
    </ul>
</div>