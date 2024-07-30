
<input type="text" hidden name="exam_user_id" value="{{ $examUser->id }}">
<input type="text" hidden name="qa_id" value="{{ $examQA->qa->id }}">
<div class="row mt-3">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <div>Câu {{ $examQA->index }}: </div>
            <div>Đề bài: {{ $examQA->qa->question }}.</div>
        </div>
    </div>
</div>

<div id='editor' style="height: 500px"></div>
<textarea name="answer" hidden></textarea>
