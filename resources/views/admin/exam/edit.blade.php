@extends('admin.layouts.master')

@section('title')
    Cập nhật công việc
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Công việc
        @endslot
        @slot('title')
            Cập nhật công việc
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật công việc</h4>
                    <form action="{{ route('tasks.update', $data_edit->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        @include('admin.task._form')

                        <div class="row justify-content-end">
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-primary">Cập nhật công việc</button>
                                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </div>
                    </form>
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

    <script>
        function changeDepartment() {
            var id = $(`select[name="department_id"]`).val();
            if (id){
                $.ajax({
                    url: "/admin/users/get-user-list-by-department/"+id,
                    type: "GET",
                    success: function (respon) {
                        if (respon.data) {
                            $('select[name="users[]"]').empty();
                            if (respon.data.length > 0) {
                                $(`select[name="users[]"]`).prop('disabled', false);
                                $.each(respon.data, function(index, item) {
                                    $('select[name="users[]"]').append('<option value="' + item.id + '">' + item.name + '</option>');
                                });
                                // Cập nhật select2 để áp dụng placeholder mới
                                $(`select[name="users[]"]`).data('placeholder', 'Chọn người thực hiện');
                            }
                            else {
                                $(`select[name="users[]"]`).prop('disabled', true);
                                // Cập nhật select2 để áp dụng placeholder mới
                                $(`select[name="users[]"]`).data('placeholder', 'Không có người thực hiên');
                            }
                            $(`select[name="users[]"]`).select2({
                                placeholder: $(`select[name="users[]"]`).data('placeholder')
                            });
                            $('select[name="users[]"]').select2();
                        }
                    },
                    errors: function () {
                        alert('Lỗi server!!!');
                    }
                });
            }
            else {
                $(`select[name="users[]"]`).prop('disabled', true);
            }
        }
    </script>
@endsection

@section('css')
    <!-- datepicker css -->
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
