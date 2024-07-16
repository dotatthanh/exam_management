@extends('admin.layouts.master')

@section('title')
    Thêm vai trò
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Vai trò
        @endslot
        @slot('title')
            Thêm vai trò
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thêm vai trò</h4>

                    <form method="POST" action="{{ route('roles.store') }}" enctype="multipart/form-data">

                        @include('admin.role._form', ['routeType' => 'create'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
