<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
        return [
            'code' => 'required|max:10',
            'name' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Mã học phần là trường bắt buộc.',
            'code.max' => 'Mã học phần không được dài quá :max ký tự.',
            'name.required' => 'Tên học phần là trường bắt buộc.',
            'name.max' => 'Tên học phần không được dài quá :max ký tự.',
        ];
    }
}
