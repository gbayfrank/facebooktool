<?php
namespace App\Helpers\Admin;

class Button {
    public static function createAIconTextButton($text, $href = '#', $aClass, $icon) {        
        $btnHtml = '';
        $btnHtml = \sprintf('<a class="btn %s" href="%s">
                            %s
                            <span>%s</span>
                        </a>', $aClass, $href, $icon, $text);
        return $btnHtml;
    }

    public static function createSwitchCheckbox($name, $checked = false) {
        $btnHtml = '';
        $textChecked = ($checked === true) ? "checked" : "";
        $btnHtml = \sprintf('<div class="switch">
                                <label>
                                    %s
                                    <input type="checkbox" name="" %s>
                                    <span class="lever"></span>
                                </label>
                            </div>', $name, $textChecked);
        return $btnHtml;
    }
}