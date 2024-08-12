<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'class_id' => 'required',
            'course_id' => 'required',
            'exam_quantity' => 'required|numeric|max:8|min:1',
            'time' => 'required|numeric|min:15|max:180',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after_or_equal:start_time',
        ];

        if (auth()->user()->hasRole('Admin')) {
            $rules['user_id'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => 'Tên lớp học là trường bắt buộc.',
            'name.max' => 'Tên lớp học không được dài quá :max ký tự.',
            'class_id.required' => 'Tên lớp học là trường bắt buộc.',
            'course_id.required' => 'Tên học phần là trường bắt buộc.',
            'exam_quantity.required' => 'Số đề thi là trường bắt buộc.',
            'exam_quantity.max' => 'Số đề thi không được dài quá :max.',
            'exam_quantity.min' => 'Số đề thi ít nhất phải là :min.',
            'exam_quantity.numeric' => 'Số đề thi phải là dạng số.',
            'time.required' => 'Thời gian thi là trường bắt buộc.',
            'time.max' => 'Thời gian thi không được dài quá :max.',
            'time.min' => 'Thời gian thi ít nhất phải là :min.',
            'time.numeric' => 'Thời gian thi phải là dạng số.',
            'start_time.required' => 'Giờ bắt đầu là trường bắt buộc.',
            'start_time.date_format' => 'Giờ bắt đầu không đúng định dạng.',
            'end_time.required' => 'Giờ kết thúc là trường bắt buộc.',
            'end_time.date_format' => 'Giờ kết thúc không đúng định dạng.',
            'end_time.after_or_equal' => 'Giờ kết thúc phải sau giờ bắt đầu.',
        ];

        if (auth()->user()->hasRole('Admin')) {
            $messages['user_id.required'] = 'Tên giáo viên là trường bắt buộc.';
        }

        return $messages;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'start_time' => formatDate($this->input('start_time'), 'H:i'),
            'end_time' => formatDate($this->input('end_time'), 'H:i'),
        ]);
    }
}
