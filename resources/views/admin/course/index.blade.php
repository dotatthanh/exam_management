@extends('admin.layouts.master')

@section('title')
    Danh sách học phần
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Học phần
        @endslot
        @slot('title')
            Danh sách học phần
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách học phần</h4>

                    <form method="GET" action="{{ route('courses.index') }}" class="row mb-2">
                        <div class="col-sm-3">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên học phần">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                            </button>
                        </div>

                        {{-- @can('Thêm học phần') --}}
                        <div class="col-sm-6">
                            <div class="text-sm-end">
                                <a href="{{ route('courses.create') }}"
                                    class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i
                                        class="mdi mdi-plus mr-1"></i> Thêm học phần</a>
                            </div>
                        </div>
                        {{-- @endcan --}}
                    </form>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 70px;" class="text-center">STT</th>
                                    <th>Mã học phần</th>
                                    <th>Tên học phần</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($courses as $item)
                                    <tr>
                                        <td class="text-center">{{ $stt++ }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                {{-- @can('Chỉnh sửa học phần') --}}
                                                <li class="list-inline-item px">
                                                    <a href="{{ route('courses.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                </li>
                                                {{-- @endcan --}}

                                                {{-- @can('Xóa học phần') --}}
                                                <li class="list-inline-item px">
                                                    <form method="post" action="{{ route('courses.destroy', $item->id) }}">
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

                    {{ $courses->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
