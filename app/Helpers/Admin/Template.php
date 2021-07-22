<?php
namespace App\Helpers\Admin;
use Config;
use Illuminate\Support\Facades\Storage;

class Template {
    public function __construct() {
        
    }

    public static function getPrefixAdmin() {
        return Config::get('gbayvn.url.prefix_admin');
    }

    public static function showItemHistory($by, $time) {
        $xhtml = sprintf('<p><i class="fa fa-user"></i> %s</p>
                            <p><i class="fa fa-clock-o"></i> %s</p>', $by, date(Config::get('gbayvn.format.short_time', 'H:m:s d/m/Y'), strtotime($time)));
        return $xhtml;
    }

    public static function showItemStatus($controllerName, $id, $active) {
        $tmpActive = Config::get('gbayvn_admin_theme.button.active');
        $activeValue = array_key_exists($active, $tmpActive) ? $active : 'default';
        
        $currentTemplateActive = $tmpActive[$activeValue];
        $link  = route($controllerName . '.active', ['active' => $active, 'id' => $id]);

        $xhtml = sprintf('<a href="%s" class="btn %s btn-sm">%s</a>', $link, $currentTemplateActive['class'], $currentTemplateActive['name']);
        return $xhtml;
    }

    // Change button hiển thị nội dung của Slider
    public static function showItemContentSlider($controllerName, $id, $contentSlider) {
        $tmpContentSlider   = Config::get('gbayvn_admin_theme.button.show_content_slider');
        $contentSliderValue = array_key_exists($contentSlider, $tmpContentSlider) ? $contentSlider : 'yes';
        
        $currentTemplateContentSlider = $tmpContentSlider[$contentSliderValue];
        $link  = route($controllerName . '.content-slider', ['contentSlider' => $contentSlider, 'id' => $id]);

        $xhtml = sprintf('<a href="%s" class="btn %s btn-sm">%s</a>', $link, $currentTemplateContentSlider['class'], $currentTemplateContentSlider['name']);
        return $xhtml;
    }
    // 
    public static function showIsHome($controllerName, $id, $isHomeValue) {
        $tmpIsHome      = Config::get('gbayvn.template.is_home');
        $isHomeValue    = array_key_exists($isHomeValue, $tmpIsHome) ? $isHomeValue : '1';

        $currentTemplateIsHome = $tmpIsHome[$isHomeValue];
        $isHomeValue           = ($isHomeValue === 1) ? 'show' : 'hidden';
        $link  = route($controllerName . '.isHome', ['is_home' => $isHomeValue, 'id' => $id]);

        $xhtml = sprintf('<a href="%s" class="btn btn-round %s">%s</a>', $link, $currentTemplateIsHome['class'], $currentTemplateIsHome['name']);
        return $xhtml;
    }

    public static function showItemThumb($diskName, $thumbName, array $options = []) {
        $default_options = array(
            'class' => '',
            'id'    => '',
            'alt'   => '',
            'width' => 'auto',
            'height'=> 'auto',
            'onchange' => ''
        );

        $options = array_merge($default_options, $options);

        $html_attr = '';
        foreach($options as $attr => $value) {
            $html_attr .= ($value !== '') ? sprintf('%s="%s" ', $attr, $value) : '';
        }

        $xhtml = sprintf('<img src="%s" %s>', Storage::disk($diskName)->url($thumbName), $html_attr);
        return $xhtml;
    }

    public static function showItemSelect($controllerName, $id, $displayValue, $fieldName) {
        $tmpDisplay = Config::get('gbayvn.template.' . $fieldName);

        $url   = route($controllerName . '.' . $fieldName, [$fieldName => 'value_new', 'id' => $id]);
        $xhtml = sprintf('<select name="select_change_attr" data-url="%s" class="form-control">', $url);

        foreach($tmpDisplay as $key => $value) {
            $xhtmlSelected = ($key === $displayValue) ? 'selected="selected"' : '';
            $xhtml .= sprintf('<option value="%s" %s>%s</a>', $key, $xhtmlSelected, $value['name']);
        }

        $xhtml .= '</select>';
        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id) {
        $tmpButton      = Config::get('gbayvn_admin_theme.button_action');
        $buttonInArea   = Config::get('gbayvn_admin_theme.config.button');

        $controllerName = (array_key_exists($controllerName, $buttonInArea)) ? $controllerName : 'admin.default';
        $listButtons    = $buttonInArea[$controllerName];

        $xhtml = '';
        foreach($listButtons as $btn) {
            $currentButton  = $tmpButton[$btn]; 
            $route          = $controllerName . '.' . $currentButton['route-name'];    

            $link           = route($route, ['id' => $id]);

            $htmlJS = ($currentButton['onclick'] !== '') ? sprintf('onclick="%s"', $currentButton['onclick']) : '';
            $xhtml .= sprintf('<a href="%s" title="%s" class="btn %s" %s><i class="fa %s"></i></a>',
                                $link, $currentButton['title'], $currentButton['btn'], $htmlJS, $currentButton['icon']);
        } 

        return $xhtml;
    }

    public static function showFilterActive($controllerName, $items, $itemsActiveCount) {
        $html = '';
        if($items->total() > 0) {
            $activeConfig = Config::get('gbayvn_admin_theme.button.active');

            $htmlA  = '';
            $url    = '';
            
            foreach($itemsActiveCount as $data) {
                if(array_key_exists($data['is_active'], $activeConfig)) {
                    $params = array(
                        'filter_active' => $data['is_active']
                    );
                    if(!empty($_GET)) {
                        $params = array_merge($_GET, $params);
                        $urlSearch = '';
                        $i = 0;
                        foreach($params as $key => $value) {
                            $urlSearch .= ($i === 0) ? '?' . $key . '=' . $value : '&' . $key . '=' . $value;
                            $i++;
                        }
                        $url = route($controllerName) . $urlSearch;
                    } else {
                        $url = route($controllerName) . '?filter_active=' . $data['is_active'];
                    }

                    $classGbayActive = (isset($_GET['filter_active']) && $_GET['filter_active'] === $data['is_active']) ? 'gbay-a-active' : '';

                    $htmlA .= sprintf('<a href="%s" class="col-dark-gray waves-effect m-r-10 %s">                                    
                                            %s (%s)
                                        </a>', $url, $classGbayActive, $activeConfig[$data['is_active']]['name'], $data['count']);
                }
                
            }
            $html .= sprintf('<div class="col-md-8 col-sm-8">
                                <div class="gbay-btn-group m-l-15">
                                    %s
                                </div>
                            </div>', $htmlA);
        }
        return $html;
    }

    public static function showButtonFilter($controllerName, $itemsStatusCount, $currentFilterStatus, $paramsSearch) {
        $xhtml = null;
        $tmpStatus = Config::get('gbayvn.template.status');

        if(count($itemsStatusCount) > 0) {
            // Them vao phan tu all o dau mang
            array_unshift($itemsStatusCount, [
                'count' => array_sum(array_column($itemsStatusCount, 'count')),
                'status'=> 'all'
            ]);

            foreach($itemsStatusCount as $item) {
                $statusValue = $item['status'];
                $statusValue = array_key_exists($statusValue, $tmpStatus) ? $statusValue : 'default';

                $currentTemplateStatus = $tmpStatus[$statusValue];
                $link   = route($controllerName) . '?filter_status=' . $statusValue;

                if($paramsSearch['value'] !== '') {
                    $link .= "&search_field=" . $paramsSearch['field'] . "&search_value=" . $paramsSearch['value'];
                }

                $class  = ($currentFilterStatus === $statusValue) ? 'btn-danger' : 'btn-primary';
                $xhtml .= sprintf('<a href="%s" class="btn %s">
                                        %s <span class="badge bg-white">%s</span>
                                    </a>', $link, $class, $currentTemplateStatus['name'], $item['count']);
            }            
        }

        return $xhtml;
    }

    public static function showAreaSearch($controllerName, $paramsSearch) {
        $xhtml      = null;
        $tmpField   = Config::get('gbayvn.template.search');
        $fieldInController = Config::get('gbayvn.config.search');

        $controllerName = (array_key_exists($controllerName, $fieldInController)) ? $controllerName : 'default';
        $xhtmlField     = null;

        foreach($fieldInController[$controllerName] as $field) {
            $xhtmlField .= sprintf('<li><a href="#" class="select-field" data-field="%s">%s</a></li>', $field, $tmpField[$field]['name']);
        }

        $searchField = (in_array($paramsSearch['field'], $fieldInController[$controllerName])) ? $paramsSearch['field'] : 'all';

        $xhtml = sprintf('<div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle btn-active-field" data-toggle="dropdown" aria-expanded="false">
                                    %s <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    %s
                                </ul>
                            </div>
                            <input type="text" class="form-control" name="search_value" value="%s">
                            <input type="hidden" name="search_field" value="%s">
                            <span class="input-group-btn">
                                <button id="btn-clear-search" type="button" class="btn btn-success" style="margin-right: 0px">Xóa tìm kiếm</button>
                                <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                            </span>                            
                        </div>', $tmpField[$searchField]['name'], $xhtmlField, $paramsSearch['value'], $searchField);

        return $xhtml;
    }

    public static function showDatetimeFrontend($dateTime) {
        return date_format(date_create($dateTime), Config::get('gbayvn.format.short_time'));
    }

    public static function showContent($content, $length, $prefix = '...') {
        $prefix = ($length === 0) ? '' : $prefix;
        $content = str_replace(['<p>', '</p>'], '', $content);
        return preg_replace('/\s+?(\S+)?$/', '', substr($content, 0, $length)) . $prefix;
    }
}