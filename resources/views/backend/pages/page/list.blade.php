@php
    use App\Helpers\Hightlight as Hightlight;
    use App\Helpers\Admin\Template as Template;
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
        @include('backend.templates.error')
        @include('backend.templates.gbayvn_notify')
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>
                            Danh sách
                            <small class="antoo" style="color:red;font-weight: 500;"></small>
                        </h3>                        
                        <div class="row">
                            <div class="col-md-7 col-sm-7 form-group has-feedback">
                                <div class="row"> 
                                    <div class="gbay-select mr-15">
                                        @php
                                            $data_number_items = Config::get('gbayvn_admin_theme.select.show_number');
                                            $selected = (isset($_GET['number_items'])) ? $_GET['number_items'] : '10';
                                            $search_value = (isset($_GET['search_value']) && $_GET['search_value'] !== '') ? 'value=' . $_GET['search_value'] : '';
                                        @endphp
                                        <label>Hiển thị
                                            <select name="gbay_number_items" id="gbay_number_items" class="form-control input-sm">
                                                @foreach ($data_number_items as $key => $val)
                                                @if ($selected == $key)
                                                <option value="{{ $key }}" selected>{{ $val }}</option>
                                                @else 
                                                <option value="{{ $key }}">{{ $val }}</option>
                                                @endif                                                
                                                @endforeach  
                                            </select>
                                            Phần tử
                                        </label>
                                    </div>
                                    <button id="delete_items" title="Xóa được chọn" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>   
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="row">
                                    <div class="input-group gbay-search">
                                        @php
                                            $data = [
                                                'all'       => 'Tất cả',
                                                'name'      => 'Tên'
                                            ];
                                            $selected = (isset($_GET['search_field']) && $_GET['search_field'] !== 'all') ? $_GET['search_field'] : 'all';
                                            $search_value = (isset($_GET['search_value']) && $_GET['search_value'] !== '') ? 'value=' . $_GET['search_value'] : '';
                                        @endphp
                                        <label>
                                            <select name="search_field" id="search_field" class="form-control input-sm"> 
                                                @foreach ($data as $key => $val)
                                                    @if ($selected === $key)
                                                    <option value="{{ $key }}" selected>{{ $val }}</option>
                                                    @else
                                                    <option value="{{ $key }}">{{ $val }}</option>
                                                    @endif
                                                @endforeach   
                                            </select>
                                        </label>
                                        <input type="text" class="form-control" name="search_value" id="search_value" {{ $search_value }} placeholder="Tìm...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" id="btn_search_field" type="button">Tìm!</button>
                                        </span>
                                    </div>
                                </div>   
                            </div>
                        </div>                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            {!! Template::showFilterActive($controllerName, $items, $itemsActiveCount) !!}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th><input type="checkbox" id="check-all" name="check-all" class="flat" /></th>
                                        <th class="column-title">Tên trang</th>
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
                                        $name           = Hightlight::show(strip_tags($val['name']), $params['search'], 'name', 65); 
                                        $active         = Template::showItemStatus($controllerName, $id, $val['is_active']);
                                        $create         = Template::showItemHistory($val['created_by_id'], $val['created_at']);
                                        $updated        = Template::showItemHistory($val['updated_by_id'], $val['updated_at']);
                                        $listBtnAction  = Template::showButtonAction($controllerName, $id);
                                    @endphp
                                    <tr class="{{ $class }} pointer">
                                        <td class="a-center"><input type="checkbox" class="flat" name="items[]" value="{{ $id }}" /></td>
                                        <td>{!! $name !!}</td>
                                        <td>{!! $active !!}</td>
                                        <td>{!! $create !!}</td>
                                        <td>{!! $updated !!}</td>
                                        <td class="last">{!! $listBtnAction !!}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                        @include('backend.templates.list_empty', ['colspan' => 6])
                                    @endif    
                                </tbody>
                            </table>                            
                        </div>
                        @if(count($items) > 0)
                        {{ $items->links('backend.pagination.pagination') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.elements.jslist')
@endsection