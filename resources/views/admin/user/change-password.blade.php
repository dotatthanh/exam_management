@extends('admin.layouts.master')

@section('title')
    Thêm tài khoản
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Tài khoản
        @endslot
        @slot('title')
            Thêm tài khoản
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Thông tin cơ bản</h4>
                    <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>

                    <form method="POST" action="{{ route('users.change-password', auth()->id()) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center mb-3">
                            <div class="col-sm-3">
                                <label for="name">Mật khẩu hiện tại <span class="text-danger">*</span> :</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="password_old" type="password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                                    {!! $errors->first('password_old', '<span class="error">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-sm-3">
                                <label for="name">Mật khẩu mới <span class="text-danger">*</span> :</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                                    {!! $errors->first('password', '<span class="error">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-sm-3">
                                <label for="name">Nhập lại mật khẩu mới <span class="text-danger">*</span> :</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                                    {!! $errors->first('password_confirmation', '<span class="error">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
