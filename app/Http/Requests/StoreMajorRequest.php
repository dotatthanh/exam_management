<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMajorRequest extends FormRequest
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
            'name' => 'required|max:255',
            'department_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên chuyên ngành là trường bắt buộc.',
            'name.max' => 'Tên chuyên ngành không được dài quá :max ký tự.',
            'department_id.required' => 'Tên khoa là trường bắt buộc.',
        ];
    }
}
