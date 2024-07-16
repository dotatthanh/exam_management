<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabelRequest extends FormRequest
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
            'color' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhãn dán là trường bắt buộc.',
            'name.max' => 'Tên nhãn dán không được dài quá :max ký tự.',
            'color.required' => 'Màu sắc là trường bắt buộc.',
        ];
    }
}
