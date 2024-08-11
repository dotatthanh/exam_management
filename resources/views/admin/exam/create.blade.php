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
                    <div id="countdown" class="float-end"></div>
                    <h4 class="card-title mb-4">Phòng: {{ $examRoom->name }}</h4>
                    <div>Thời gian: {{ $examRoom->time }} phút | Thời gian bắt đầu: {{ $examRoom->start_time }} phút | Thời gian kết thúc: {{ $examRoom->end_time }} phút</div>
                    <div class="row justify-content-end">
                        <div class="col-2" id="alert">
                            @if (!empty($result) && $result->is_correct == true)
                                <div class="card bg-success text-white-50">
                                    <div class="card-body">
                                        <h5 class="mb-4 text-white"><i class="mdi mdi-check-all me-3"></i> Đã làm đúng</h5>
                                        <p class="card-text">Bạn đã làm đúng và được điểm.</p>
                                    </div>
                                </div>
                            @else
                                <div class="card bg-danger text-white-50">
                                    <div class="card-body">
                                        <h5 class="mb-4 text-white"><i class="mdi mdi-alert-outline me-3"></i>Chưa làm đúng</h5>
                                        <p class="card-text">Bạn chưa làm đúng và chưa được điểm.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('exams.store') }}" method="post">
                        @csrf
                        @include('admin.exam._form')

                        <div class="row mt-3">
                            <div class="col">
                                <button type="button" id='run' class="btn btn-primary">Chạy code</button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Xem thông báo</button>
                                <button type="button" class="btn btn-success waves-effect waves-light float-end" onclick="submitExam()">Nộp bài</button>
                                <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                                    <div class="offcanvas-header">
                                        <h5 id="offcanvasBottomLabel"></h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <nav aria-label="...">
                                <ul class="pagination">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @php
                                            $active = '';
                                            $current = false;
                                            if ($questionIndex == $i) {
                                                $current = true;
                                                $active = 'active';
                                            }
                                        @endphp
                                        <li class="page-item {{ $active }}">
                                            @if ($current)
                                                <span class="page-link">
                                                    {{ $i }}
                                                    <span class="sr-only">(current)</span>
                                                </span>
                                            @else
                                                <a class="page-link" href="{{ route('exams.exam', [
                                                    'examUserId' => $examUser->id,
                                                    'question' => $i,
                                                ]) }}">{{ $i }}</a>
                                            @endif
                                        </li>
                                    @endfor
                                </ul>
                            </nav>
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

    <!-- Sweet Alerts js -->
    <script src="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="https://www.unpkg.com/ace-builds@latest/src-noconflict/ace.js"></script>
    <script>
        var result = @json($result);
        var answer = result ? result.answer : ''
        var editor = ace.edit("editor", {
            theme: "ace/theme/textmate",
            mode: "ace/mode/c_cpp",
            value: answer

// #include <stdio.h>

// int main() {
//     int a, b, c;
//     printf("Nhap vao a = ");
//     scanf("%d", &a);
//     printf("Nhap vao b = ");
//     scanf("%d", &b);
//     c = a + b;
//     printf("a + b = %d", c);
//     return 0;
// }
        });

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var examUserId = $('input[name="exam_user_id"]').val()
        $(document).ready(function () {
            $('#run').click(function() {
                var qaId = $('input[name="qa_id"]').val()

                $.ajax({
                    url: `{{ route('exams.store-answer') }}`,
                    type: "POST",
                    data: {
                        _token: csrfToken,
                        exam_user_id: examUserId,
                        qa_id: qaId,
                        answer: editor.getValue()
                    },
                    success: function (respon) {
                        let data = respon.data
                        if (data) {
                            let html = ``;

                            if (data.is_correct == true) {
                                html = `
                                    <div class="card bg-success text-white-50">
                                        <div class="card-body">
                                            <h5 class="mb-4 text-white"><i class="mdi mdi-check-all me-3"></i> Đã làm đúng</h5>
                                            <p class="card-text">Bạn đã làm đúng và được điểm.</p>
                                        </div>
                                    </div>
                                `;
                            } else {
                                html = `
                                    <div class="card bg-danger text-white-50">
                                        <div class="card-body">
                                            <h5 class="mb-4 text-white"><i class="mdi mdi-alert-outline me-3"></i>Chưa làm đúng</h5>
                                            <p class="card-text">Bạn chưa làm đúng và chưa được điểm.</p>
                                        </div>
                                    </div>
                                `;
                            }

                            $(`#alert`).html(html)
                        }
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status == 400) {
                            let respon = xhr.responseJSON
                            let message = respon.message
                            showCanvas (message)
                            $(`#alert`).html(`
                                    <div class="card bg-danger text-white-50">
                                        <div class="card-body">
                                            <h5 class="mb-4 text-white"><i class="mdi mdi-alert-outline me-3"></i>Chưa làm đúng</h5>
                                            <p class="card-text">Bạn chưa làm đúng và chưa được điểm.</p>
                                        </div>
                                    </div>
                                `)
                        }
                        if (xhr.status == 500) {
                            alert('Lỗi server!!!');
                        }
                    }

                })
            })

            function showCanvas (message) {
                $(`.offcanvas-body`).html(message)
                let offcanvas = new bootstrap.Offcanvas($(`#offcanvasBottom`)).show();
            }

            var interval = setInterval(function() {
                var now = new Date().getTime();
                var deadline = new Date("{{ $examRoom->end_time }}").getTime();
                var timeLeft = deadline - now;

                if (timeLeft <= 0) {
                    clearInterval(interval);
                    submitExam();
                } else {
                    // Update countdown display
                    var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    document.getElementById('countdown').innerHTML = "Thời gian còn lại: " + minutes + "m " + seconds + "s ";
                }
            }, 1000);

        })
        function submitExam() {
            $.ajax({
                url: `{{ route('exams.calculate-exam-score') }}`,
                type: "POST",
                data: {
                    _token: csrfToken,
                    exam_user_id: examUserId,
                },
                success: function (respon) {
                    point = respon.data
                    Swal.fire({
                        title: "Đã hết thời gian làm bài thi!",
                        icon: "info",
                        html: `Bạn đã đạt được ${point} điểm.`,
                        timer: 60000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        willClose: () => {
                            window.location = '/admin/exam_rooms'
                        }
                    }).then((result) => {
                        if (result.isConfirmed === true || result.dismiss === Swal.DismissReason.timer) {
                            window.location = '/admin/exam_rooms'
                        }
                    });
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 400) {
                        alert('Lỗi code!!!');
                    }
                    if (xhr.status == 500) {
                        alert('Lỗi server!!!');
                    }
                }
            })

        }
    </script>
@endsection

@section('css')
    <!-- datepicker css -->
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Sweet Alert-->
    <link href="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
