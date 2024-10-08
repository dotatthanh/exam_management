@extends('admin.layouts.master')

@section('title')
    Cập nhật phòng thi
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Phòng thi
        @endslot
        @slot('title')
            Cập nhật phòng thi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật phòng thi</h4>

                    <form method="POST" action="{{ route('exam_rooms.update', $data_edit->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.exam-room._form', ['routeType' => 'edit'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

@section('script')
    <!-- datepicker css -->
    <script src="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- select 2 plugin -->
    <script src="{{ asset('assets\libs\select2\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('assets\js\pages\ecommerce-select2.init.js') }}"></script>
    <script src="{{ asset('assets\libs\bootstrap-timepicker\bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets\libs\bootstrap-touchspin\bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets\libs\spectrum-colorpicker\spectrum-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets\libs\bootstrap-maxlength\bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets\js\pages\form-advanced.init.js') }}"></script>
@endsection

@section('css')
    <!-- datepicker css -->
    <link href="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets\libs\spectrum-colorpicker\spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets\libs\bootstrap-timepicker\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection
