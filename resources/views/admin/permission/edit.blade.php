@extends('admin.layouts.master')

@section('title')
    Cập nhật quyền
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quyền
        @endslot
        @slot('title')
            Cập nhật quyền
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách quyền</h4>
                    <p class="card-title-desc">Chọn quyền cho vai trò</p>

                    <form method="POST" action="{{ route('permissions.update', $role->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.permission._form', ['routeType' => 'edit'])

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
