<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoRequest extends FormRequest
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
            'title'                 => 'bail|max:80',
            'description'           => 'bail|max:165',
            'keywords'              => 'bail|max:255',
            'canonical'             => 'bail|nullable|url',
            'facebook_title'        => 'bail|max:80',
            'facebook_desciption'   => 'bail|max:165',
            'twitter_title'         => 'bail|max:80',
            'twitter_desciption'    => 'bail|max:165',
        ];
    }

    public function messages()
    {
        return [
            'title.max'         => 'Thẻ title không được lớn hơn :max ký tự.',
            'description.max'   => 'Thẻ description không được lớn hơn :max ký tự.',
            'keywords.max'      => 'Thẻ keywords không được lớn hơn :max ký tự.',
            'canonical.url'     => 'Canonical Url không hợp lệ.',
            'facebook_title.max'       => 'Facebook title không được lớn hơn :max ký tự.',
            'facebook_desciption.max'  => 'Facebook description không được lớn hơn :max ký tự.',
            'twitter_title.max'        => 'Twitter title không được lớn hơn :max ký tự.',
            'twitter_desciption.max'   => 'Twitter description không được lớn hơn :max ký tự.',
        ];
    }
}
