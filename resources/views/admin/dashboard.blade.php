@extends('admin.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Trang chủ @endslot
@slot('title')  @endslot
@endcomponent

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Biểu đồ thống kê công việc theo trạng thái</h4>

                <div>
                    <div id="donut-chart" class="apex-charts"></div>
                </div>

                <div class="text-center text-muted">
                    <div class="row justify-content-center">
                        @foreach ($data as $key => $item)
                            <div class="col-2 mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle me-1" style="color: {{ $statusColors[$key] }}"></i> {{ $statusTasks[$item['status']] }}</p>
                                <h5>{{ $item['count'] }}</h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection
@section('script')
    <script>
        var series = @json($counts);
        var labels = @json($status);
        var colors = @json($statusColors);
    </script>
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Saas dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/saas-dashboard.init.js') }}"></script>
@endsection
