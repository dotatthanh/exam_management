@extends('admin.layouts.master')

@section('title')
    Danh sách kết quả thi
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Kết quả thi
        @endslot
        @slot('title')
            Danh sách kết quả thi
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách kết quả thi</h4>

                    <form method="GET" action="{{ route('exam_results.index') }}" class="row mb-2">
                        <div class="col-sm-3">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên phòng thi">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                            </button>
                        </div>

                    </form>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 70px;" class="text-center">STT</th>
                                    <th>Tên phòng thi</th>
                                    <th>Tên lớp thi</th>
                                    <th>Tên học phần</th>
                                    <th>Ngày thi</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($examRooms as $item)
                                    <tr>
                                        <td class="text-center">{{ $stt++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->class->name }}</td>
                                        <td>{{ $item->course->name }}</td>
                                        <td>{{ formatDate($item->start_time, 'd-m-Y') }}</td>
                                        <td class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                {{-- @can('Chi tiết kết quả thi') --}}
                                                <li class="list-inline-item px">
                                                    <a href="{{ route('exam_results.show', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Xem"><i class="fa fa-eye text-success"></i></a>
                                                </li>
                                                {{-- @endcan --}}
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $examRooms->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
