@php
use App\Helpers\Admin\Template as Template;

    $titleForm = 'Tạo mới';
    $arr_data_is_active = [
                            'yes' => 'Kích hoạt',
                            'no' => 'Không',
                        ];  
    $flag_is_active = (old('is_active') === 'no') ? 'no' : 'yes';
    $input_id_hidden = '';
    $nameVal = (old('name')) ? old('name') : '';
    $slugVal = (old('slug')) ? old('slug') : '';
    $bodyVal = (old('body')) ? old('body') : '';
    $thumbIDVal = (old('page_thumb_id')) ? old('page_thumb_id') : '';

    $thumbVal = '';
    $thumbPreview = '';
    if(old('thumb')) {
        $thumbVal = old('thumb');
        $thumbPreview = '<img src="'. old('thumb') .'" width="100%" />';
    } 
    if(!empty($item['id'])) {
        $titleForm = 'Chỉnh sửa';   
        $input_id_hidden = sprintf('<input type="hidden" name="id" value="%s">', $item['id']);
        $nameVal = (old('name')) ? old('name') : $item['name'];
        $slugVal = (old('slug')) ? old('slug') : $item['slug'];
        $bodyVal = (old('body')) ? old('body') : $item['body'];
        if(old('thumb')) {
            $thumbVal = old('thumb');
            $thumbPreview = '<img src="'. old('thumb') .'" width="100%" />';
        }  else {
            $thumbVal = $item['thumb'];
            $thumbPreview = '<img src="'. $thumbVal .'" width="100%" />';
        }

        // Xử lý phần is_active
        if((old('is_active') == 'yes' || old('is_active') == '') && $item['is_active'] == 'yes') {
            $flag_is_active = 'yes';
        }
        if((old('is_active') == 'no' || old('is_active') == '') && $item['is_active'] == 'no') {
            $flag_is_active = 'no';
        }
        $input_id_hidden = sprintf('<input type="hidden" name="id" value="%s">', $item['id']);
    }
@endphp
@extends('backend.main')
@section('content')
<script src="{{ asset('/backend/vendors/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<div class="right_col">
    <div>
        @include('backend.elements.page_title')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
            </div>
            <div class="col-md-6 col-sm-6">
                <a href="{{ route($controllerName) }}" class="btn btn-success" style="float:right;">
                    <i class="fa fa-mail-reply-all"></i>
                    Danh sách
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        @include('backend.templates.error')
        @include('backend.templates.gbayvn_notify')
        <form class="form-horizontal form-label-left" method="POST" action="{{ route($controllerName . '.save') }}">
            @csrf
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="x_panel">
                        <div class="x_title">
                            <h3>{{ $titleForm }}</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p>
                                <label for="name">Tiêu đề *:</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ $nameVal }}">
                            </p>
                            <p>
                                <label for="slug">Đường dẫn tĩnh:</label>
                                <input type="text" id="slug" class="form-control" name="slug"  value="{{ $slugVal }}">
                            </p>
                            <p>
                                <label for="body">Nội dung:</label>
                                <textarea id="body" name="body" class="form-control"> {{ $bodyVal }}</textarea>
                            </p>
                        </div>
                    </div>
                    @include('backend.elements.seo')
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <h4>Trang</h4>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div>
                                <label><strong>Trạng thái</strong></label>                                                              
                                <div>
                                     @foreach ($arr_data_is_active as $key => $value)
                                        @if ($flag_is_active === $key)
                                        {{ $value }} <input type="radio" class="flat" name="is_active" value="{{ $key }}" checked />
                                        @else 
                                        {{ $value }} <input type="radio" class="flat" name="is_active" value="{{ $key }}" />
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <label>Ảnh đại diện</label>
                            <div class="input-group">                                
                                <input type="text" class="form-control" name="thumb" id="page_thumb" value="{{ $thumbVal }}">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" onclick="media_show('page_thumb', 'page_thumb_preview', 'uploads_id')">Chọn!</button>
                                </span>
                            </div>
                            <div id="page_thumb_preview">{!! $thumbPreview !!}</div>
                            <div><input type="hidden" name="uploads_id" id="uploads_id" value="{{ $thumbIDVal }}"></div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                {!! $input_id_hidden !!}
                                <button type="submit" class="btn btn-success">Tạo</button>
                                <button class="btn btn-primary" type="button">Hủy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('backend.elements.media')
    <script>
        tinymce.init({
            selector: 'textarea#body', // change this value according to your HTML
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            importcss_append: true,
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            
        });
    </script>
</div>
@endsection
