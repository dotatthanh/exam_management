<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'priority' => 'required',
            'progress' => 'nullable|numeric|min:0|max:100',
            'estimated_time' => 'nullable|date',
            'status' => 'required',
            'description' => 'nullable|max:1000',
        ];

        if (!$this->parent_id && auth()->user()->hasRole('Admin')) {
            $rules['department_id'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'title.max' => 'Tiêu đề không được dài quá :max ký tự.',
            'start_date.date' => 'Ngày bắt đầu không đúng định dạng ngày tháng năm.',
            'end_date.date' => 'Ngày kết thúc không đúng định dạng ngày tháng năm.',
            'priority.required' => 'Mức độ ưu tiên là trường bắt buộc.',
            'progress.required' => 'Tiến độ là trường bắt buộc.',
            'progress.numeric' => 'Tiến độ phải là định dạng số.',
            'progress.min' => 'Tiến độ nhỏ nhất là 0.',
            'progress.max' => 'Tiến độ không được quá :max.',
            'estimated_time.date' => 'Thời gian dự kiến hoàn thành không đúng định dạng ngày tháng năm.',
            'status.required' => 'Trạng thái là trường bắt buộc.',
            'description.required' => 'Mô tả là trường bắt buộc.',
            'description.required' => 'Mô tả không được quá :max.',
        ];

        if (!$this->parent_id && auth()->user()->hasRole('Admin')) {
            $messages['department_id.required'] = 'Bộ môn là trường bắt buộc.';
        }

        return $messages;
    }
}
