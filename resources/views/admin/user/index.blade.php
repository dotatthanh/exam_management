@extends('admin.layouts.master')

@section('title')
    Danh sách tài khoản
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Tài khoản
        @endslot
        @slot('title')
            Danh sách tài khoản
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách tài khoản</h4>

                    <form method="GET" action="{{ route('users.index') }}" class="row mb-2">
                        <div class="col-sm-3">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập họ và tên">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                            </button>
                        </div>

                        {{-- @can('Thêm tài khoản') --}}
                        <div class="col-sm-6">
                            <div class="text-sm-end">
                                <a href="{{ route('users.create') }}"
                                    class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i
                                        class="mdi mdi-plus mr-1"></i> Thêm tài khoản</a>
                            </div>
                        </div>
                        {{-- @endcan --}}
                    </form>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 70px;" class="text-center">STT</th>
                                    <th>Mã</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Bộ môn</th>
                                    <th>Họ và tên</th>
                                    <th>Vai trò</th>
                                    <th>Giới tính</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $stt++ }}</td>
                                        <td>{{ $user->code }}</td>
                                        <td>
                                            @if ($user->avatar)
                                                <div>
                                                    <img class="rounded-circle avatar-xs" src="{{ asset($user->avatar) }}" alt="">
                                                </div>
                                            @else
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle text-uppercase">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $user->department?->name }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge bg-secondary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ date("d-m-Y", strtotime($user->birthday)) }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td class="text-center">
                                            @if ($user->id != 1)
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                {{-- @can('Chỉnh sửa tài khoản') --}}
                                                <li class="list-inline-item px">
                                                    <a href="{{ route('users.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                </li>
                                                {{-- @endcan --}}

                                                {{-- @can('Xóa tài khoản') --}}
                                                @if (auth()->id() != $user->id)
                                                <li class="list-inline-item px">
                                                    <form method="post" action="{{ route('users.destroy', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                    </form>
                                                </li>
                                                @endif
                                                {{-- @endcan --}}
                                            </ul>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $users->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
