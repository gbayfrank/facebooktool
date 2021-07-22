@php
    use Illuminate\Support\Facades\Storage;
    $dir_date = [];
@endphp
@extends('backend.main')
@section('content')
<div class="right_col">
    <div>
        @include('backend.elements.page_title')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <a href="{{ route( $controllerName . '.new' ) }}" class="btn btn-success">
                    <i class="fa fa-upload"></i>
                    Tải lên
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 form-group has-feedback">
                                <div class="row"> 
                                    <div class="gbay-select mr-15">
                                        <label>Thời gian
                                            <select name="gbay_checkbox_date" id="gbay_checkbox_date" class="form-control input-sm">
                                                @if (isset($_GET['dir_date']))
                                                <option value="all">Tất cả</option>
                                                @else 
                                                <option value="all" selected>Tất cả</option>
                                                @endif
                                                
                                                @foreach ($dirDate as $date)
                                                @if (isset($_GET['dir_date']) && $_GET['dir_date'] === $date)
                                                <option value="{{ $date }}" selected>{{ $date }}</option>
                                                @else 
                                                <option value="{{ $date }}">{{ $date }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                    <button id="delete_items" title="Xóa được chọn" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>                                
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="row">
                                    <div class="input-group gbay-search">
                                        @php
                                            $data = [
                                                'all'       => 'Tất cả',
                                                'name'      => 'Tên',
                                                'alt'       => 'Alt',
                                                'caption'   => 'Caption',
                                                'content'   => 'Content'
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
                            @if(count($items) > 0)
                            @foreach($items as $key => $val)
                            @php
                                if(in_array($val['extension'], ['gif', 'svg'])) {
                                    $src = Storage::disk($storageSystems)->url($val['extension'] . '.png');
                                } else {
                                    $src = Storage::disk($storageName)->url($val['dir_date'] . '/' . $val['name_not_extension'] . '-150x150.' . $val['extension']);
                                }
                                
                            @endphp
                            <div class="col-md-2">
                                <div class="thumbnail">
                                    <div class="image view view-first">
                                        <img style="width: 100%; display: block;" src="{{ $src }}" alt="image">
                                        <div class="mask">
                                            <div class="tools tools-bottom">
                                                <a href="{{ route($controllerName . '.edit', ['id' => $val['id']]) }}"><i class="fa fa-pencil"></i></a>
                                                <a id="delete-file" onclick="delete_file(this, {{ $val['id'] }})"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h2>Không có hình ảnh nào</h2>
                            @endif
                        </div>
                    </div>
                    @if(count($items) > 0)
                        {{ $items->links('backend.pagination.pagination') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    delete_file = (obj, id) => {
        const c = confirm("Bạn chắc chắn muốn xóa");
        if(c == true) {
            postUploadData('{{ route( $controllerName . ".ajax-delete" ) }}', {id : id})
            .then(function(data) {
                alert(data.success);
                obj.parentElement.parentElement.parentElement.parentElement.parentElement.remove();
            })
            .catch(error => {
                console.log(error);
            });
        } 
    }

    const gbay_checkbox_date = document.getElementById('gbay_checkbox_date');
    gbay_checkbox_date.onchange = () => {
        const pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);
		params 			= ['page', 'search_field', 'search_value'];
        let link		= "";

        const dir_date = gbay_checkbox_date.value;

        for(let i = 0; i < params.length; i++) {
            if (searchParams.has(params[i]) ) {
				link += params[i] + "=" + searchParams.get(params[i]) + "&";
			}
        }     

        window.location.href = pathname + "?" + link.slice(0,-1) + 'dir_date='+ dir_date;
    }

    const btn_search_field = document.getElementById('btn_search_field');
    btn_search_field.onclick = () => {
        const pathname	= window.location.pathname;
		let searchParams= new URLSearchParams(window.location.search);
		params 			= ['page', 'dir_date'];
        let link		= "";

        for(let i = 0; i < params.length; i++) {
            if (searchParams.has(params[i]) ) {
				link += params[i] + "=" + searchParams.get(params[i]) + "&";
			}
        }     
        const search_field = document.getElementById('search_field').value;
        const search_value = document.getElementById('search_value').value;
        window.location.href = pathname + "?" + link.slice(0,-1) + '&search_field='+ search_field + '&search_value='+ search_value;
    }
})
</script>
<style>
    #delete-file {
        cursor: pointer;
    }
    .thumbnail {
        height: 135px;
    }
</style>
@endsection
