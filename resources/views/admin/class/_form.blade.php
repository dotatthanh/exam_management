@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Tên lớp học <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên lớp học" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="major_id">Tên chuyên ngành <span class="text-danger">*</span></label>
            <select class="form-control select2" name="major_id"  id="parent-category-id">
                <option value="">Chọn chuyên ngành</option>
                @foreach ($majors as $major)
                    <option value="{{ $major->id }}"
                        {{ old('major_id', $data_edit->major_id ?? '') == $major->id ? 'selected' : '' }}>
                        {{ $major->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('major_id', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('classes.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
