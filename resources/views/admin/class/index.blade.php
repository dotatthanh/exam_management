@extends('admin.layouts.master')

@section('title')
    Danh sách lớp học
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Lớp học
        @endslot
        @slot('title')
            Danh sách lớp học
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách lớp học</h4>

                    <form method="GET" action="{{ route('classes.index') }}" class="row mb-2">
                        <div class="col-sm-3">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên lớp học">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                            </button>
                        </div>

                        {{-- @can('Thêm lớp học') --}}
                        <div class="col-sm-6">
                            <div class="text-sm-end">
                                <a href="{{ route('classes.create') }}"
                                    class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i
                                        class="mdi mdi-plus mr-1"></i> Thêm lớp học</a>
                            </div>
                        </div>
                        {{-- @endcan --}}
                    </form>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 70px;" class="text-center">STT</th>
                                    <th>Tên lớp học</th>
                                    <th>Tên chuyên ngành</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($classes as $item)
                                    <tr>
                                        <td class="text-center">{{ $stt++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->major->name }}</td>
                                        <td class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                {{-- @can('Chỉnh sửa lớp học') --}}
                                                <li class="list-inline-item px">
                                                    <a href="{{ route('classes.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                </li>
                                                {{-- @endcan --}}

                                                {{-- @can('Xóa lớp học') --}}
                                                <li class="list-inline-item px">
                                                    <form method="post" action="{{ route('classes.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                    </form>
                                                </li>
                                                {{-- @endcan --}}
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $classes->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
