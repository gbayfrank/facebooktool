@php
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
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="input-group gbay-search">
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
                                        
                                    @endphp
                                    <tr class="pointer">
                                    </tr>
                                    @endforeach
                                    @else
                                        @include('backend.templates.list_empty', ['colspan' => 7])
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
@endsection