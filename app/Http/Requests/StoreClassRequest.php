<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
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
            'major_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên lớp học là trường bắt buộc.',
            'name.max' => 'Tên lớp học không được dài quá :max ký tự.',
            'major_id.required' => 'Tên chuyên ngành là trường bắt buộc.',
        ];
    }
}
