@extends('backend.main')
@section('content')
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
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>{{ $titleForm }}</h3>
                        <div class="clearfix"></div>
                    </div>
                    @php
                        $alt = (old('alt')) ? old('alt') : $item->alt;
                        $title = (old('title')) ? old('title') : $item->title;
                        $caption = (old('caption')) ? old('caption') : $item->caption;
                        $content = (old('content')) ? old('content') : $item->content;
                    @endphp
                    <div class="x_content">
                        <img src="{{ $item->url }}" alt="" width="100%" height="100%" style="margin-bottom:15px;">
                        <form class="form-horizontal form-label-left" action="{{ route( $controllerName . '.post-edit' ) }}" method="POST">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="alt"><strong>Thẻ Alt</strong></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" id="alt" name="alt" class="form-control" value="{{ $alt }}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="title"><strong>Tiêu đề</strong></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $title }}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="caption"><strong>Chú thích</strong></label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" id="caption" name="caption" class="form-control" value="{{ $caption }}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="content"><strong>Mô tả</strong></label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea id="content" name="content" class="form-control">{{ $content }}</textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-success">Sửa</button>
                                    <button class="btn btn-primary" type="reset">Làm mới</button>
                                </div>
                            </div>
                        </form>                        
                    </div>
                </div>                
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h4>Thông tin</h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div>Tải lên vào: <strong>{{ $item->created }}</strong></div>
                        <div>Tải lên bởi: <strong>{{ $item->created_by }}</strong></div>
                        <div>Tên file: <strong>{{ $item->name }}</strong></div>
                        <label for="url">Url:</label>
                        <input type="text" id="url" class="form-control" name="url" value="{{ $item->url }}">
                        <button class="btn btn-primary" type="button" style="margin-top:5px;" onclick="copyUrl()">Copy vào bộ nhớ tạm</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <script>
        copyUrl = () => {
            let url = document.getElementById("url");
            url.select();
            url.setSelectionRange(0, 99999);

            document.execCommand("copy");
        }
    </script>
</div>
@endsection