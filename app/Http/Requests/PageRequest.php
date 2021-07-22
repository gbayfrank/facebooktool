<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\SeoRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    private $_seo_request;
    public function __construct() {
        $this->_seo_request = new SeoRequest();
    }
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
        $name = 'bail|required|max:255|unique:pages,name';
        if(!empty($this->id)) {
            $name .= ",$this->id";
        }
        $main = [
            'name'      => $name,
            'slug'      => 'bail|max:255',
        ];
        $seo_rules = $this->_seo_request->rules();
        return array_merge($main, $seo_rules);
    }

    public function messages()
    {
        $main = [
            'name.required' => 'Tiêu đề không được để trống.',
            'name.unique'   => 'Tiêu đề đã tồn tại.',
            'name.max'      => 'Tiêu đề không được dài quá :max ký tự.',
            'slug.max'      => 'Slug không được dài quá :max ký tự.',
        ];
        $seo_messages = $this->_seo_request->messages();
        return array_merge($main, $seo_messages);
    }
}
