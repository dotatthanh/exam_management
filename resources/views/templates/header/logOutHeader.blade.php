    <header class="header">
        <div class="top-bar">
            <ul class="top-list">
                <li>
                    <a class="top-link" href="#!">Quốc gia</a>
                </li>
                <li>
                    <a class="top-link" href="#!">Thể loại</a>
                    <ul class="">
                        @foreach ($genres as $genre)
                        <li>
                            <a class="top-link" href="{{ route('web.movie-category', $genre['id']) }}">{{ $genre['name'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <div class="top-act">
                <div class="top-act__group">
                    <!-- Button kích hoạt thanh tìm kiếm -->
                    <a href="#!" class="top-act__search" id="searchToggle">
                        <img src="{{ asset('static/assets/icons/search.svg') }}" alt="Search" />
                    </a>
                    <!-- Thanh tìm kiếm ẩn -->
                    <div id="searchBar" class="search-container" style="display: none;">
                        <input class="searchInput" type=" text" id="searchInput" placeholder="Nhập nội dung tìm kiếm..." />
                        <button class="searchButton" id="searchButton"> <img
                                src="{{ asset('static/assets/icons/search.svg') }}" /></button>
                    </div>

                    <a href="#!" class="top-act__noti">
                        <img src="{{ asset('static/assets/icons/bell.svg') }}" alt="" />
                    </a>

                    <!-- Dropdown -->
                    @include('components.dropdown-logOut')
                </div>
            </div>
        </div>
    </header>
