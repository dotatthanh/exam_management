@extends('admin.layouts.master')

@section('title')
    Thi
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Thi
        @endslot
        @slot('title')
            Thi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thi</h4>
                    <form action="{{ route('exams.store') }}" method="post">
                        @csrf
                        @include('admin.exam._form')

                        <div class="row justify-content-end">
                            <div class="col-lg-10">
                                <button type="submit" id='test' class="btn btn-primary">Nộp bài</button>
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

    <script src="https://www.unpkg.com/ace-builds@latest/src-noconflict/ace.js"></script>
    <script>
        var editor = ace.edit("example", {
            theme: "ace/theme/textmate",
            mode: "ace/mode/javascript",
            value: `#include <stdio.h>
#include <stdlib.h>

int main(int argc, char *argv[]) {
    if (argc != 2) {
        printf("Usage: %s <number>", argv[0]);
        return 1;
    }
    int a = atoi(argv[1]);
    printf("Bình phương của %d là: %d", a, a * a);
    return 0;
}`
        });

        $(document).ready(function () {
            $('#test').click(function() {
                $('textarea[name="code"]').val(editor.getValue())
            })
        })
    </script>
@endsection

@section('css')
    <!-- datepicker css -->
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
