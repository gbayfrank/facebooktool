@php
    use App\Helpers\Hightlight as Hightlight;
    use App\Helpers\Admin\Button as Button;
    use App\Helpers\Admin\Template as Template;
    use App\Helpers\Admin\Form as Form;
    $buttonThemMoiConfig = Config::get('gbayvn_admin_theme.button.them_moi');
    $buttonStatusConfig = Config::get('gbayvn_admin_theme.button.status');
    $checkboxAll = Form::createCheckbox([
    'label' => 'class="form-check-label"',
    'id' => 'check_all',
    'name' => 'check_all'
    ]);

    $select_label_option = array(
    'text_left' => 'Hiển thị',
    'text_right' => 'mục',
    );
    $select_show_number = Form::crateSelect('show_number', ['name' => 'show_number'], false, $select_label_option, '10');

    $search_label_option = array();
    $select_search = Form::crateSelect('search_option', ['name' => 'search_option'], false, $search_label_option);
@endphp
@extends('backend.main')
@section('content')
<script>
    const token = '{{ csrf_token() }}'
</script>
<div class="right_col">
    <div>
        @include('backend.elements.page_title')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
            </div>
            <div class="col-md-6 col-sm-6">
                <a href="{{ route($controllerName . '.form') }}" class="btn btn-success" style="float:right;">
                    <i class="fa fa-plus"></i>
                    Thêm mới
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>
                            Danh sách
                            <small class="antoo" style="color:red;font-weight: 500;"></small>
                        </h3>                        
                        <div class="row">
                            <div class="col-md-8 col-sm-8 form-group has-feedback">
                                {!! $select_show_number !!}
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="input-group gbay-search">
                                    {!! $select_search !!}
                                    <input type="text" class="form-control" placeholder="Tìm...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="button">Tìm!</button>
                                    </span>
                                </div>
                            </div>
                        </div>                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            @if(count($items) > 0)
                                <div class="col-md-8 col-sm-8">
                                    <div class="gbay-btn-group m-l-15">
                                        <a href="#" class="m-r-10 gbay-a-active">
                                            Tất cả ({{ count($items) }})
                                        </a>
                                        @foreach ($itemsStatusCount as $item)
                                        <a href="#" class="col-dark-gray waves-effect m-r-10">
                                            {{ $buttonStatusConfig[$item['status']]['name'] }}&nbsp;({{ $item['count'] }})
                                        </a>
                                        @endforeach
                                        <button id="delete_items" title="Xóa được chọn" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 gbay_table">
                                    
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th><input type="checkbox" id="check-all" name="check-all" class="flat" /></th>
                                        <th class="column-title">Thông tin</th>
                                        <th class="column-title">Nội dung</th>
                                        <th class="column-title">Trạng thái</th>
                                        <th class="column-title">Tạo mới</th>
                                        <th class="column-title">Chỉnh sửa</th>
                                        <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($items) > 0)
                                    @foreach($items as $key => $val)
                                    @php
                                        $index = $key + 1;
                                        $class          = ($index % 2 == 0) ? 'even' : 'odd';
                                        $id             = $val['id']; 
                                        $title          = Hightlight::show(strip_tags($val['title']), $params['search'], 'title', 65); 
                                        $description    = Hightlight::show(strip_tags($val['description']), $params['search'], 'description', 65); 
                                        $link           = Hightlight::show(strip_tags($val['link']), $params['search'], 'link', 65); 
                                        $thumb_options  = array(
                                            'alt'       => $val['name'],
                                            'width'     => '168px',
                                            'height'    => '80px'
                                        );
                                        $thumb          = Template::showItemThumb($storage, $val['thumb'], $thumb_options);
                                        $showContent    = Template::showItemContentSlider($controllerName, $id, $val['show_content']);
                                        $status         = Template::showItemStatus($controllerName, $id, $val['status']);
                                        $create         = Template::showItemHistory($val['created_by'], $val['created']);
                                        $modified       = Template::showItemHistory($val['modified_by'], $val['modified']);
                                        $listBtnAction  = Template::showButtonAction($controllerName, $id);
                                        $id_checkbox    = 'checkbox_' . $id;
                                    @endphp
                                    <tr class="{{ $class }} pointer">
                                        <td class="a-center">
                                            <input type="checkbox" class="flat" name="items[]" value="{{ $id }}" />
                                        </td>
                                        <td>
                                            <div><strong>Tiêu đề: </strong>{!! $title !!}</div>
                                            <div><strong>Mô tả: </strong>{!! $description !!}</div>
                                            <div><strong>Url: </strong>{!! $link !!}</div>
                                            <div>{!! $thumb !!}</div>
                                        </td>
                                        <td>{!! $showContent !!}</td>
                                        <td>{!! $status !!}</td>
                                        <td>{!! $create !!}</td>
                                        <td>{!! $modified !!}</td>
                                        <td class="last">{!! $listBtnAction !!}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                        @include('backend.templates.list_empty', ['colspan' => 7])
                                    @endif    
                                </tbody>
                            </table>                            
                        </div>
                        @if(count($items) > 0)
                        <div class="footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="gbay_table_info">Hiển thị từ 1 tới 10 của 16 mục</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    {{ $items->links('backend.pagination.pagination') }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection