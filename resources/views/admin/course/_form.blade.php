@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="code">Mã học phần <span class="text-danger">*</span></label>
            <input id="code" name="code" type="text" class="form-control" placeholder="Tên học phần" value="{{ old('code', $data_edit->code ?? '') }}">
            {!! $errors->first('code', '<span class="error">:message</span>') !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Tên học phần <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên học phần" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('courses.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
