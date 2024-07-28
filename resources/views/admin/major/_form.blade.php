@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Tên chuyên ngành <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên chuyên ngành" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="department_id">Tên khoa <span class="text-danger">*</span></label>
            <select class="form-control select2" name="department_id"  id="parent-category-id">
                <option value="">Chọn khoa</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id', $data_edit->department_id ?? '') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('department_id', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('majors.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
