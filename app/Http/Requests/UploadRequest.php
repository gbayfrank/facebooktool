<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'alt'     => 'max:255',
            'title'   => 'max:255',
            'caption' => 'max:255',
            'content' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'alt.max' => 'Alt không được dài quá :max ký tự.',
            'title.max'   => 'Tiêu đề không được dài quá :max ký tự.',
            'caption.max' => 'Chú thích không được dài quá :max ký tự.',
            'content.max' => 'Nội dung không được dài quá :max ký tự.',
        ];
    }
}
