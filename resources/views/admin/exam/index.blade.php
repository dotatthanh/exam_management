@extends('admin.layouts.master')

@section('title')
    Danh sách công việc
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Công việc
        @endslot
        @slot('title')
            Danh sách công việc
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách công việc</h4>

                    <form method="GET" action="{{ route('tasks.index') }}" class="row mb-2">
                        <div class="col-sm-3">
                            <div class="search-box mr-2 mb-2">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập tiêu đề">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                            </button>
                        </div>

                        {{-- @can('Thêm công việc') --}}
                        <div class="col-sm-6">
                            <div class="text-sm-end">
                                <a href="{{ route('tasks.create') }}"
                                    class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">
                                    <i class="mdi mdi-plus mr-1"></i> Thêm công việc
                                </a>
                            </div>
                        </div>
                        {{-- @endcan --}}
                    </form>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 70px;" class="text-center">STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Bộ môn</th>
                                    <th>Người thực hiện</th>
                                    <th>Nhãn dán</th>
                                    <th>Mức độ ưu tiên</th>
                                    <th>Tiến độ</th>
                                    <th>Thời gian dự kiến hoàn thành</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($tasks as $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->department->name }}</td>
                                    <td>
                                        @foreach ($item->users as $user)
                                            <span class="badge bg-primary">{{ $user->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($item->labels as $label)
                                            <span class="badge" style="background-color: {{ $label->color }};">{{ $label->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ getConst('priorityTasks')[$item->priority] }}</td>
                                    <td>{{ $item->progress }}</td>
                                    <td>{{ formatDate($item->estimated_time, 'd-m-Y') }}</td>
                                    <td>{{ getConst('statusTasks')[$item->status] }}</td>
                                    <td class="text-center">
                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                            {{-- @can('Xem chi tiết công việc') --}}
                                            <li class="list-inline-item px">
                                                <a href="{{ route('tasks.show', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Xem chi tiết"><i class="bx bx bx-detail text-success"></i></a>
                                            </li>
                                            {{-- @endcan --}}

                                            {{-- @can('Chỉnh sửa công việc') --}}
                                            <li class="list-inline-item px">
                                                <a href="{{ route('tasks.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                            </li>
                                            {{-- @endcan --}}

                                            {{-- @can('Xóa công việc') --}}
                                            <li class="list-inline-item px">
                                                <form method="post" action="{{ route('tasks.destroy', $item->id) }}">
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

                    {{ $tasks->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
