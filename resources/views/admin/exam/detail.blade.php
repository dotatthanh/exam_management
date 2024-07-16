@extends('admin.layouts.master')

@section('title')
    Chi tiết công việc
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Công việc
        @endslot
        @slot('title')
            Chi tiết công việc
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Chi tiết công việc</h4>
                    @include('admin.task._form', ['isDetailPage' => 1])

                    @if ($data_edit->isParent())
                    <div>
                        @hasanyrole('Admin|Trưởng bộ môn')
                        <a href="{{ route('tasks.create', ['parent_id' => $data_edit->id]) }}" class="float-end">Thêm</a>
                        @endhasanyrole

                        <h4 class="card-title mb-4">Công việc con</h4>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap">
                                <tbody>
                                    @foreach ($data_edit->subTasks as $subTask)
                                    <tr>
                                        <td>
                                            <a href="{{ route('tasks.show', $subTask->id) }}" class="ms-3">{{ $subTask->title }}</a>
                                        </td>
                                        <td>{{ getConst('statusTasks')[$subTask->status] }}</td>
                                        <td>
                                            <td class="text-center">
                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                    <li class="list-inline-item px">
                                                        <a href="{{ route('tasks.edit', $subTask->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                    </li>

                                                    <li class="list-inline-item px">
                                                        <form method="post" action="{{ route('tasks.destroy', $subTask->id) }}">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if ($comments->count() > 0)
                    <div class="mt-5">
                        <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Bình luận :</h5>

                        @foreach ($comments as $item)
                        <div class="d-flex py-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                        @if ($item->user->avatar)
                                            <img class="rounded-circle header-profile-user"
                                            src="{{ asset($item->user->avatar) }}"
                                            alt="Header Avatar">
                                        @else
                                            <i class="bx bxs-user"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="font-size-14 mb-1">{{ $item->user->name }} <small class="text-muted float-end">{{ timeAgo($item->created_at) }}</small></h5>
                                <p class="text-muted">{{ $item->content }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="mt-4">
                        <h5 class="font-size-16 mb-3">Để lại lời nhắn</h5>

                        <form method="post" action="{{ route('tasks.comment', $data_edit->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="commentmessage-input" class="form-label">Lời nhắn</label>
                                <textarea class="form-control" id="commentmessage-input" placeholder="Lời nhắn của bạn..." rows="3" name="content"></textarea>
                                {!! $errors->first('content', '<span class="error">:message</span>') !!}
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success w-sm">Gửi</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
@section('script')
    <!-- bootstrap datepicker -->
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <!-- Summernote js -->
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>

    <!-- form repeater js -->
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/task-create.init.js') }}"></script>

    <!-- select 2 plugin -->
    <script src="{{ asset('assets\libs\select2\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('assets\js\pages\ecommerce-select2.init.js') }}"></script>
@endsection

@section('css')
    <!-- datepicker css -->
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
