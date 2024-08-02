@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

@csrf
<div class="row">
	<div class="col-sm-4 mb-3">
		@foreach ($permissions as $permission)
			@if ($loop->iteration == 1)
                <h5>Quản lý tài khoản</h5>
			@endif

			<div class="custom-control custom-checkbox custom-checkbox-info mb-3">
				<input name="permissions[{{ $permission->id }}]" type="checkbox" class="custom-control-input" id="customCheckcolor{{ $permission->id }}" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
				<label class="custom-control-label" for="customCheckcolor{{ $permission->id }}">{{ $permission->name }}</label>
			</div>

			@if ($loop->iteration == 4)
				</div>
				<div class="col-sm-4 mb-3">
                <h5>Quản lý vai trò</h5>
            @endif

			@if ($loop->iteration == 8)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý quyền</h5>
            @endif

			@if ($loop->iteration == 11)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý khoa</h5>
            @endif

			@if ($loop->iteration == 15)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý chuyên ngành</h5>
            @endif

			@if ($loop->iteration == 19)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý lớp học</h5>
            @endif

			@if ($loop->iteration == 23)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý học phần</h5>
            @endif

			@if ($loop->iteration == 27)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý câu hỏi và đáp án</h5>
            @endif

			@if ($loop->iteration == 31)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý phòng thi</h5>
            @endif

			@if ($loop->iteration == 35)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý thi</h5>
            @endif

            @if ($loop->iteration == 36)
				</div>
				<div class="col-sm-4 mb-3">
                    <h5>Quản lý kết quả thi</h5>
            @endif
		@endforeach
	</div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('permissions.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
