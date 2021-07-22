@php
    use App\Helpers\Admin\Template as Template;

    $titleForm = 'Tạo mới';
    $thumb = '';
    $statusChecked      = 'checked';
    $showContentChecked = '';
    $title          = '';
    $description    = '';
    $link           = '';
    $link_title     = '';
    $thumb_alt      = '';
    $input_id_hidden = '';
    if(!empty($item['id'])) {
        $titleForm = 'Chỉnh sửa';
        $thumb_options = array(
            'id'        => 'gbay_img_slider',
            'alt'       => $item['name'],
            'width'     => '336px',
            'height'    => '160px',
        );
        $thumb = Template::showItemThumb($storage, $item['thumb'], $thumb_options);

        if($item['status'] === 'inactive') $statusChecked = '';
        if($item['show_content'] === 'yes') $showContentChecked = 'checked';
        $title          = $item['title'];
        $description    = $item['description'];
        $link           = $item['link'];
        $link_title     = $item['link_title'];
        $thumb_alt      = $item['thumb_alt'];
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
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>{{ $titleForm }}</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" method="POST">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status"><strong>Trạng thái</strong></label>
                                <div class="col-md-6 col-sm-6">
                                    <label>
                                        <input type="checkbox" class="js-switch" name="status" {{ $statusChecked }} /> Kích hoạt
                                    </label>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="show_content"><strong>Nội dung</strong></label>
                                <div class="col-md-6 col-sm-6">
                                    <label>
                                        <input type="checkbox" class="js-switch" name="show_content" {{ $showContentChecked }} /> Hiển thị
                                    </label>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="thumb"><strong>Ảnh slider</strong></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" class="custom-file-input" id="thumb" name="thumb" onchange="readURL(this);">
                                    <label class="custom-file-label form-control" for="thumb">Chọn tập tin</label>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="title"><strong>Tiêu đề</strong></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $title }}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description"><strong>Mô tả</strong></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea id="description" name="description" class="form-control">{{ $description }}</textarea>
                                </div>
                            </div>  
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="link"><strong>Link</strong></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="link" name="link" class="form-control" value="{{ $link }}" />
                                </div>
                            </div>  
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="link_title"><strong>Tiêu đề Link</strong></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="link_title" name="link_title" class="form-control" value="{{ $link_title }}" />
                                </div>
                            </div> 
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="thumb_alt"><strong>Alt ảnh slider</strong></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="thumb_alt" name="thumb_alt" class="form-control" value="{{ $thumb_alt }}" />
                                </div>
                            </div>                          
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    {!! $input_id_hidden !!}
                                    <button type="submit" class="btn btn-success">Gửi</button>
                                    <button class="btn btn-primary" type="button">Hủy</button>                                    
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>                
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h4>Ảnh slider</h4>
                        <div><small style="color:red;">Kích thước khuyến nghị: 840x395px</small></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! $thumb !!}
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea#description',  // change this value according to your HTML
            plugins: 'code',
            toolbar: 'undo redo | code',
            height : "280",
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
        readURL = (input) => {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = e => {
                    const gbay_img_slider = document.getElementById('gbay_img_slider');
                    gbay_img_slider.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</div>
@endsection