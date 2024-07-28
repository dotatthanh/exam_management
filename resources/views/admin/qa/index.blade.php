@extends('admin.layouts.master')

@section('title')
    Danh sách câu hỏi và đáp án
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Câu hỏi và đáp án
        @endslot
        @slot('title')
            Danh sách câu hỏi và đáp án
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách câu hỏi và đáp án</h4>

                    <form method="GET" action="{{ route('qas.index') }}" class="row mb-2">
                        <div class="col-sm-3">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập câu hỏi">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                            </button>
                        </div>

                        {{-- @can('Thêm câu hỏi và đáp án') --}}
                        <div class="col-sm-6">
                            <div class="text-sm-end">
                                <a href="{{ route('qas.create') }}"
                                    class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i
                                        class="mdi mdi-plus mr-1"></i> Thêm câu hỏi và đáp án</a>
                            </div>
                        </div>
                        {{-- @endcan --}}
                    </form>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 70px;" class="text-center">STT</th>
                                    <th>Câu hỏi</th>
                                    <th>Đáp án</th>
                                    <th>Các tham số truyền vào</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($qas as $item)
                                    <tr>
                                        <td class="text-center">{{ $stt++ }}</td>
                                        <td>{{ $item->question }}</td>
                                        <td>{{ $item->answer }}</td>
                                        <td>{{ $item->input }}</td>
                                        <td class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                {{-- @can('Chỉnh sửa câu hỏi và đáp án') --}}
                                                <li class="list-inline-item px">
                                                    <a href="{{ route('qas.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                </li>
                                                {{-- @endcan --}}

                                                {{-- @can('Xóa câu hỏi và đáp án') --}}
                                                <li class="list-inline-item px">
                                                    <form method="post" action="{{ route('qas.destroy', $item->id) }}">
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

                    {{ $qas->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
