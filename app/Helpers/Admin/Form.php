<?php
namespace App\Helpers\Admin;

use Config;

class Form {
    /**
     * Hàm tạo checkbox input
     */
    public static function createCheckbox(array $options = [], $type = 'filled-in', $text = '') {        
        $html = '';

        $default_options = [
            'label'     => '',
            'class'     => 'gbay_checkbox',
            'id'        => '',
            'name'      => '',
            'checked'   => '',
            'disabled'  => ''
        ];

        $data_options = array_merge($default_options, $options);

        $labelAttr  = $data_options['label'];
        $inputAttr  = '';
        $inputClass = '';

        foreach($data_options as $name => $value) {
            if($name === 'class' || $name === 'label') continue;
            $inputAttr .= ($value !== '') ? sprintf(' %s="%s"', $name, $value) : '';
        }

        switch($type) {
            case 'purple': 
                $inputClass = sprintf('class="form-check-input %s"', $data_options['class']);
                break;
            case 'filled-in': 
                // $inputClass = sprintf('class="filled-in %s"', $data_options['class']);
                $inputClass = sprintf('class="%s"', $data_options['class']);
                break;
            default: 
                $inputClass = sprintf('class="%s"', $data_options['class']);
                break;
        }

        $inputAttr = $inputClass . $inputAttr;

        // if($type === 'purple') {
        //     $html = \sprintf('<label %s>%s
        //                                 <input type="checkbox" %s>
        //                                 <span class="form-check-sign">
        //                                     <span class="check"></span>
        //                                 </span>
        //                             </label>', $labelAttr, $text, $inputAttr);
        // } else {
        //     $html = \sprintf('<label %s>
        //                             <input type="checkbox" %s>
        //                             <span>%s</span>
        //                         </label>', $labelAttr, $inputAttr, $text);
        // }
        if($type === 'purple') {
            $html = \sprintf('<input type="checkbox" %s>', $inputAttr);
        } else {
            $html = \sprintf('<input type="checkbox" %s>', $inputAttr);
        }
        return $html;
    }

    public static function crateSelect($keyoption_data, array $select_options, $please_select = true, array $label_option = [], $value_select = null) {
        $html = '';
        
        $default_select_options = array(
            'class' => 'gbay-select form-control'
        );

        $select_options = array_merge($default_select_options, $select_options);
        $selectAttr = '';
        foreach($select_options as $name => $value) {
            $selectAttr .= ($value !== '') ? sprintf(' %s="%s"', $name, $value) : '';
        }

        $label_string_attr = array_key_exists('string_attr', $label_option) ? $label_option['string_attr'] : '';
        $label_text_left   = array_key_exists('text_left', $label_option) ? $label_option['text_left'] : '';
        $label_text_right  = array_key_exists('text_right', $label_option) ? $label_option['text_right'] : '';

        $option = '';

        if($please_select) {
            $text_please_select = Config::get('gbayvn_admin_theme.config.text.please_select', 'Vui lòng chọn');
            $option .= ($value_select === null) ? sprintf('<option disabled selected>%s</option>', $text_please_select) : sprintf('<option disabled>%s</option>', $text_please_select);
        }

        $option_data_tmp = Config::get('gbayvn_admin_theme.select');

        $keyoption_data = array_key_exists($keyoption_data, $option_data_tmp) ? $keyoption_data : 'default';

        $option_data = $option_data_tmp[$keyoption_data];
        foreach($option_data as $value => $text) {
            $option .= ($value_select != null && $value == $value_select) ? sprintf('<option value="%s" selected>%s</option>', $value, $text) : sprintf('<option value="%s">%s</option>', $value, $text);
        }

        $html = sprintf('<label %s>%s 
                            <select %s>
                                %s
                            </select> 
                            %s
                        </label>', $label_string_attr, $label_text_left, $selectAttr, $option, $label_text_right);
        return $html;
    }
}