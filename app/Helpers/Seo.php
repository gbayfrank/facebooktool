<?php
namespace App\Helpers;

use Config;

class Seo {
    private $params;
    private $object_type;
    private $object_id;
    private $permalink;
    private $title;
    private $data_url;

    public function __construct() {
        $this->data_url = Config::get('gbayvn_url');
    }

    public function get_seo_params($params, $object_type, $object_id) {
        $this->params       = $params;
        $this->object_type  = $object_type;
        $this->object_id    = $object_id;  

        $seoParams = array();

        if(!empty($params['seo_main_info_id'])) {
            $seoParams['id'] = $params['seo_main_info_id'];
        }        
        $seoParams['permalink']         = $this->create_permalink();
        $seoParams['object_type']       = $this->object_type;
        $seoParams['object_id']         = $this->object_id;
        $seoParams['title']             = $this->create_title();
        $seoParams['description']       = $this->params['description'];
        $seoParams['keywords']          = $this->params['keywords'];
        $seoParams['breadcrumb_title']  = $this->params['name'];
        $seoParams['canonical']         = $this->params['canonical'];
        $seoParams['main_keyword']      = $this->create_main_keyword();
        $seoParams['focus_keywords']    = $this->create_focus_keywords();
        $seoParams['is_cornerstone']    = $this->params['is_cornerstone'];
        $seoParams['is_robots_index']       = $this->params['is_robots_index'];
        $seoParams['is_robots_follow']      = $this->params['is_robots_follow'];
        $seoParams['is_robots_imageindex']  = $this->create_meta_robots_adv('noimageindex');
        $seoParams['is_robots_archive']     = $this->create_meta_robots_adv('noarchive');
        $seoParams['is_robots_snippet']     = $this->create_meta_robots_adv('nosnippet');
        $seoParams['schema_page_type']      = $this->params['schema_page_type'];
        $seoParams['open_graph_title']          = ($this->params['open_graph_title'] == '') ? $this->title : $this->params['open_graph_title'];
        $seoParams['open_graph_description']    = $this->params['open_graph_description'];

        $open_graph_image_data = $this->meta_image();
        $seoParams['open_graph_image']          = $open_graph_image_data['image_url'];
        $seoParams['open_graph_image_id']       = $open_graph_image_data['image_id'];
        $seoParams['open_graph_image_meta']     = $this->create_json_image_meta($open_graph_image_data['image_url']);

        $seoParams['twitter_title']          = ($this->params['twitter_title'] == '') ? $this->title : $this->params['twitter_title'];
        $seoParams['twitter_description']    = $this->params['twitter_description'];
        $twitter_image_data = $this->meta_image('twitter');
        $seoParams['twitter_image']          = $twitter_image_data['image_url'];
        $seoParams['twitter_image_id']       = $twitter_image_data['image_id'];
        
        return $seoParams;
    }

    public function create_meta_robots_adv($key) {
        // Flag = 1 mac dinh co
        $flag = 1;
        if(!empty($this->params['meta_robots_adv'])) {
            if(in_array($key, $this->params['meta_robots_adv'])) {
                $flag = 0;
            }
        }
        return $flag;
    }

    public function create_focus_keywords() {
        $data = array();
        if(!empty($this->params['focus_keywords'])) {
            for($i = 0; $i < count($this->params['focus_keywords']); $i++) {
                $data[$i]['focus_keywords']             = $this->params['focus_keywords'][$i];
                $data[$i]['focus_keywords_synonyms']    = $this->params['focus_keywords_synonyms'][$i];
            }
            return json_encode($data);
        } else {
            return null;
        }
    }

    public function create_main_keyword() {
        $data = array();
        if($this->params['main_keyword'] != '') {
            $data['keyword']            = $this->params['main_keyword'];
            $data['keyword_synonyms']   = $this->params['main_keyword_synonyms'];
            return json_encode($data);
        } else {
            return null;
        }
    }

    /**
     * Tạo json image meta
     */
    public function create_json_image_meta($image_url) {
        $data_image = array();
        if($image_url != '') {
            list($width, $height, $type, $attr) = getimagesize($image_url);
            $data_image['image_url'] = $image_url;
            $data_image['width']     = $width;
            $data_image['height']    = $height;
            return json_encode($data_image);
        } else {
            return null;
        }
    }

    /**
     * Tạo url meta image
     */
    public function meta_image($social = 'open_graph') {
        $image_data = array();

        $image_data['image_url'] = $this->params['thumb'];
        $image_data['image_id']  = $this->params['uploads_id'];

        if($social == 'open_graph' && $this->params['open_graph_image'] != '') {
            $image_data['image_url'] = $this->params['open_graph_image'];
            $image_data['image_id']  = $this->params['open_graph_image_id'];          
        } 

        if($social == 'twitter' && $this->params['twitter_image'] != '') {
            $image_data['image_url'] = $this->params['twitter_image'];
            $image_data['image_id']  = $this->params['twitter_image_id'];           
        } 

        return $image_data;
    }

    /**
     * Tạo permalink
     */
    public function create_permalink() {
        $this->permalink = env('APP_URL', 'http://localhost') . '/'. $this->data_url[$this->object_type] . '/'. $this->params['slug'] . '/';
        return $this->permalink;
    }

    /**
     * Tạo mới title nếu người dùng không nhập liệu
     */
    public function create_title() {
        if($this->params['title'] == '') {
            $this->title = (strlen($this->params['name']) > 80) ? substr($this->params['name'], 0, 80) : $this->params['name'];
        } else {
            $this->title = $this->params['title'];
        }
        return $this->title;
    }

    public function create_param_meta_robots() {
        $metaRobotsParams = array();
        $metaRobotsParams['meta_robots_index']  = $this->params['meta_robots_index'];
        $metaRobotsParams['meta_robots_follow'] = $this->params['meta_robots_follow'];
        $metaRobotsParams['meta_robots_adv']    = (!empty($this->params['meta_robots_adv'])) ? $this->params['meta_robots_adv'] : '';
        return $metaRobotsParams;
    }

    public function create_meta_robots($params) {
        $content    = '';
        
        $index  = ($params['meta_robots_index'] == 0) ? 'noindex' : 'index';
        $follow = ($params['meta_robots_follow'] == 0) ? 'nofollow' : 'follow';

        if(is_array($params['meta_robots_adv'])) {
            $noimageindex = (in_array('noimageindex', $params['meta_robots_adv'])) ? 'noimageindex' : '';
            $noarchive = (in_array('noarchive', $params['meta_robots_adv'])) ? 'noarchive' : '';
            $nosnippet = (in_array('nosnippet', $params['meta_robots_adv'])) ? 'nosnippet' : '';
        }
        

        $content = $index . ', ' . $follow;
        if($params['meta_robots_index'] == 1 && is_array($params['meta_robots_adv'])) {
            $content .= ($noimageindex !== '') ? ', ' . $noimageindex : '';
            $content .= ($noarchive !== '') ? ', ' . $noarchive : '';
            $content .= ($nosnippet !== '') ? ', ' . $nosnippet : '';
        }
        
        $html_meta_robots = '<meta name="robots" content="'. $content .'" />';
        return $html_meta_robots;
    }

    public function create_param_meta_facebook() {
        $metaFacebookParams = array();
        $metaFacebookParams['facebook_image'] = $this->params['facebook_image'];
        $metaFacebookParams['facebook_title'] = ($this->params['facebook_title'] != '') ? $this->params['facebook_title'] : $this->title;
        $metaFacebookParams['facebook_desciption'] = ($this->params['facebook_desciption'] != '') ? $this->params['facebook_desciption'] : $this->params['meta_description'];
        $metaFacebookParams['url'] = $this->permalink;

        if($this->params['facebook_image'] != '') {
            list($width, $height, $type, $attr) = getimagesize($this->params['facebook_image']);
            $metaFacebookParams['facebook_image_width']     = $width;
            $metaFacebookParams['facebook_image_height']    = $height;
        }
        return $metaFacebookParams;
    }

    public function create_facebook_preview($params) {
        $meta_facebook = '<meta property="og:locale" content="vi_VN" />';
        $meta_facebook .= '<meta property="og:type" content="article" />';

        $meta_facebook .= ($params['facebook_title'] != '') ? '<meta property="og:title" content="'. $params['facebook_title'] .'" />' : '';
        $meta_facebook .= ($params['facebook_desciption'] != '') ? '<meta napropertyme="og:description" content="'. $params['facebook_desciption'] .'" />' : '';
        $meta_facebook .= '<meta property="og:url" content="'. $this->permalink .'" />';
        if($params['facebook_image'] != '') {
            $meta_facebook .= '<meta property="og:image" content="'. $params['facebook_image'] .'" />';
            $meta_facebook .= '<meta property="og:image:width" content="'. $params['facebook_image_width'] .'" />';
            $meta_facebook .= '<meta property="og:image:height" content="'. $params['facebook_image_height'] .'" />';
        }
        return $meta_facebook;
    }

    public function create_param_meta_twitter() {
        $metaTwitterParams = array();
        $metaTwitterParams['twitter_image'] = $this->params['twitter_image'];
        $metaTwitterParams['twitter_title'] = ($this->params['twitter_title'] != '') ? $this->params['twitter_title'] : $this->title;
        $metaTwitterParams['twitter_desciption'] = ($this->params['twitter_desciption'] != '') ? $this->params['twitter_desciption'] : $this->params['meta_description'];
        return $metaTwitterParams;
    }

    public function create_twitter_preview($params) {
        $meta_twitter = '';

        $meta_twitter .= ($params['twitter_title'] != '') ? '<meta name="twitter:title" content="'. $params['twitter_title'] .'" />' : '';
        $meta_twitter .= ($params['twitter_desciption'] != '') ? '<meta name="twitter:description" content="'. $params['twitter_desciption'] .'" />' : '';
        $meta_twitter .= ($params['twitter_image'] != '') ? '<meta name="twitter:image" content="'. $params['twitter_image'] .'" />' : '';
        return $meta_twitter;
    }
}