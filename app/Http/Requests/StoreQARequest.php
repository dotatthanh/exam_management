<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQARequest extends FormRequest
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
            'question' => 'required|max:255',
            'answer' => 'required|max:255',
            'input' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'question.required' => 'Câu hỏi là trường bắt buộc.',
            'question.max' => 'Câu hỏi không được dài quá :max ký tự.',
            'answer.required' => 'Đáp án là trường bắt buộc.',
            'answer.max' => 'Đáp án không được dài quá :max ký tự.',
            'input.required' => 'Các tham số nhập là trường bắt buộc.',
            'input.max' => 'Các tham số nhập không được dài quá :max ký tự.',
        ];
    }
}
