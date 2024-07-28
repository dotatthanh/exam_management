@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Tên phòng thi <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên phòng thi" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="class_id">Tên lớp học <span class="text-danger">*</span></label>
            <select class="form-control select2" name="class_id"  id="class_id">
                <option value="">Chọn lớp học</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ old('class_id', $data_edit->class_id ?? '') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('class_id', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="course_id">Tên học phần <span class="text-danger">*</span></label>
            <select class="form-control select2" name="course_id"  id="course_id">
                <option value="">Chọn học phần</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}"
                        {{ old('course_id', $data_edit->course_id ?? '') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('course_id', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="exam_quantity">Số đề thi <span class="text-danger">*</span></label>
            <input id="exam_quantity" name="exam_quantity" type="text" class="form-control" placeholder="Số đề thi" value="{{ old('exam_quantity', $data_edit->exam_quantity ?? '') }}">
            {!! $errors->first('exam_quantity', '<span class="error">:message</span>') !!}
        </div>

    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="start_time">Giờ bắt đầu <span class="text-danger">*</span></label>
            <div class="input-group" id="timepicker-input-group2">
                <input type="text" name="start_time" class="form-control timepicker2" data-provide="timepicker">

                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
            </div>
            {!! $errors->first('start_time', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="end_time">Giờ kết thúc <span class="text-danger">*</span></label>
            <div class="input-group" id="timepicker-input-group2">
                <input type="text" name="end_time" class="form-control timepicker2" data-provide="timepicker">

                <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
            </div>
            {!! $errors->first('end_time', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="time">Thời gian thi <span class="text-danger">*</span></label>
            <input id="time" name="time" type="text" class="form-control" placeholder="Thời gian thi" value="{{ old('time', $data_edit->time ?? '') }}">
            {!! $errors->first('time', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('exam_rooms.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
