<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Quản lý</li>

                {{-- <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Trang chủ</span>
                    </a>
                </li> --}}

                @can('Xem danh sách tài khoản')
                <li>
                    <a href="{{ route('users.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Tài khoản</span>
                    </a>
                </li>
                @endcan

                {{-- <li>
                    <a href="{{ route('exams.create') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Thi</span>
                    </a>
                </li> --}}

                @can('Xem danh sách khoa')
                <li>
                    <a href="{{ route('departments.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Khoa</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách chuyên ngành')
                <li>
                    <a href="{{ route('majors.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Chuyên ngành</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách lớp học')
                <li>
                    <a href="{{ route('classes.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Lớp học</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách học phần')
                <li>
                    <a href="{{ route('courses.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Học phần</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách câu hỏi và đáp án')
                <li>
                    <a href="{{ route('qas.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Câu hỏi và đáp án</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách phòng thi')
                <li>
                    <a href="{{ route('exam_rooms.index') }}" class=" waves-effect">
                        <i class="bx bx-user"></i>
                        <span>Phòng thi</span>
                    </a>
                </li>
                @endcan

                @can(['Xem danh sách vai trò', 'Xem danh sách quyền'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-cog"></i>
                        <span>Cài đặt</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Xem danh sách vai trò')
                        <li><a href="{{ route('roles.index') }}">Vai trò</a></li>
                        @endcan
                        @can('Xem danh sách quyền')
                        <li><a href="{{ route('permissions.index') }}">Quyền</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->
