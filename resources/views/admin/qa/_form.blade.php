@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="question">Câu hỏi <span class="text-danger">*</span></label>
            <input id="question" name="question" type="text" class="form-control" placeholder="Câu hỏi" value="{{ old('question', $data_edit->question ?? '') }}">
            {!! $errors->first('question', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="answer">Tên đáp án <span class="text-danger">*</span></label>
            <input id="answer" name="answer" type="text" class="form-control" placeholder="VD: 1;2;3" value="{{ old('answer', $data_edit->answer ?? '') }}">
            {!! $errors->first('answer', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="input">Các tham số nhập vào <span class="text-danger">*</span></label>
            <input id="input" name="input" type="text" class="form-control" placeholder="VD: 1;2;3" value="{{ old('input', $data_edit->input ?? '') }}">
            {!! $errors->first('input', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('qas.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
