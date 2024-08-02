@extends('admin.layouts.master')

@section('title')
    Chi tiết kết quả thi
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Kết quả thi
        @endslot
        @slot('title')
            Chi tiết kết quả thi
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Chi tiết kết quả thi</h4>

                    <form method="GET" action="{{ route('exam_results.show', $examRoomId) }}" class="row mb-2">
                        <div class="col-sm-3">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên kết quả thi">
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
                                    <th>Tên sinh viên</th>
                                    <th>Mã đề thi</th>
                                    <th>Điểm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($examUsers as $item)
                                    <tr>
                                        <td class="text-center">{{ $stt++ }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->exam->code }}</td>
                                        <td>{{ $item->calculateExamScore() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
