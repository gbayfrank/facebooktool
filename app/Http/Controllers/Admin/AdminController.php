<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Config;

class AdminController extends Controller
{

    protected $pathViewController = "";
    protected $controllerName     = "";
    protected $titlePage          = "";
    protected $params             = [
        'pagination' => [
            'totalItemsPerPage' => 10
        ]
    ];
    protected $model;
    protected $storageName      = "gbay_public";
    protected $storageSystems   = 'gbay_systems';
    protected $public_folder    = '\/uploads\/';

    protected $number_items     = array();

    public function __construct() {
        $prefixAdmin = config('gbayvn.url.prefix_admin', 'gbay');
        $this->controllerName = $prefixAdmin . '.' . $this->controllerName;
        $this->number_items   = Config::get('gbayvn_admin_theme.select.show_number');
        view()->share([
            'titlePage'           => $this->titlePage,
            'controllerName' => $this->controllerName,
            'controllerUpload'  => $prefixAdmin . '.uploads',
            'storageName'       => $this->storageName,
            'storageSystems'    => $this->storageSystems,
        ]);
    }
    // Tạo mới slug 
    public function create_slug($params, $exception = null, $slug = '', $i = 1) {               
        if($slug == '') {
            $slug = ($params['slug'] === null) ? Str::slug($params['name'], '-') : Str::slug($params['slug'], '-');
        } 
              
        $check_slug_exists = $this->model->check_slug_exists($slug, $exception);
        if($check_slug_exists) {
            $slug = ($params['slug'] === null) ? Str::slug($params['name'], '-') : Str::slug($params['slug'], '-');
            $slug .= '-' . $i;
            $i++;
            return $this->create_slug($params, $exception, $slug, $i);
        }
        return $slug;
    }

    public function index(Request $request) {        
        $this->params['filter']['active']   = $request->input('filter_active', 'all');
        $this->params['search']['field']    = $request->input('search_field', 'all');
        $this->params['search']['value']    = $request->input('search_value', '');
        $this->params['pagination']['totalItemsPerPage']    = (in_array($request->input('number_items', 10), $this->number_items)) ? $request->input('number_items', 10) : 2;

        $items            = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        $itemsActiveCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-active']);

        $itemsTotal       = $this->model->countItems(null, ['task' => 'admin-count-items']);
        $itemsActiveCount = array_merge([['count' => $itemsTotal, 'is_active' => 'all']], $itemsActiveCount);

        return view($this->pathViewController . 'list', [
            'params'            => $this->params,
            'items'             => $items,
            'itemsActiveCount'  => $itemsActiveCount
        ]);
    }

    public function form(Request $request) {
        $item = null;

        if($request->id !==  null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
            // Chuyen chuoi data json thanh array
            if($item['main_keyword'] !== null) {
                $item['main_keyword'] = json_decode($item['main_keyword'], true);
            }
            if($item['focus_keywords'] !== null) {
                $item['focus_keywords'] = json_decode($item['focus_keywords'], true);
            }
            // dd($item);
        }

        return view($this->pathViewController . 'form', [
            'item'      => $item
        ]);
    }

    public function changeActive(Request $request) {
        $params['currentActive']    = $request->active;
        $params['id']               = $request->id;
        $this->model->changeActive($params, ['task' => 'change-active']);

        $textNotify = ($params['currentActive'] == 1) ? '<strong>CHƯA KÍCH HOẠT</strong>' : '<strong>KÍCH HOẠT</strong>';
        return redirect()->back()->with('gbayvn_notify', 'Phần tử chuyển sang trạng thái '. $textNotify .' thành công!');
    }

    public function changeType(Request $request) {
        $params['currentType']    = $request->type;
        $params['id']             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-type']);

        return redirect()->route($this->controllerName)->with('gbayvn_notify', 'Cập nhật kiểu bài viết thành công!');
    }
}