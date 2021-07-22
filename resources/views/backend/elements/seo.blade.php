@php
    $titleVal       = (old('title')) ? old('title') : '';
    $descriptionVal = (old('description')) ? old('description') : '';
    $keywordsVal    = (old('keywords')) ? old('keywords') : '';
    $canonicalVal   = (old('canonical')) ? old('canonical') : '';

    // Keyword
    $mainKeywordVal             = (old('main_keyword')) ? old('main_keyword') : '';
    $mainKeywordSynonymsVal     = (old('main_keyword_synonyms')) ? old('main_keyword_synonyms') : '';

    $noimageindex   = '';
    $noarchive      = '';
    $nosnippet      = '';
    if(old('meta_robots_adv')) {
        $noimageindex = (in_array('noimageindex', old('meta_robots_adv'))) ? 'selected' : '';
        $noarchive = (in_array('noarchive', old('meta_robots_adv'))) ? 'selected' : '';
        $nosnippet = (in_array('nosnippet', old('meta_robots_adv'))) ? 'selected' : '';
    }
    // MXH facebook
    $openGraphImageVal = '';
    $openGraphImagePrevewPreview = '';
    $openGraphImageIdVal = '';
    if(old('open_graph_image')) {
        $openGraphImageVal = old('open_graph_image');
        $openGraphImageIdVal = old('open_graph_image_id');
        $openGraphImagePrevewPreview = '<img src="'. old('open_graph_image') .'" width="100%" />';
    }

    $openGraphTitleVal       = (old('open_graph_title')) ? old('open_graph_title') : '';
    $openGraphDescriptionVal = (old('open_graph_description')) ? old('open_graph_description') : '';
    // MXH twitter
    $metaTwitterImageVal = '';
    $imgTwitterPreview = '';
    $twitterImageIdVal = '';
    if(old('twitter_image')) {
        $metaTwitterImageVal = old('twitter_image');
        $twitterImageIdVal = old('twitter_image_id');
        $imgTwitterPreview = '<img src="'. old('twitter_image') .'" width="100%" />';
    } 

    $metaTwitterTitleVal       = (old('twitter_title')) ? old('twitter_title') : '';
    $metaTwitterDescriptionVal  = (old('twitter_description')) ? old('twitter_description') : '';

    $flag_robots_index      = (old('is_robots_index') === '0') ? 0 : 1;
    $flag_robots_follow     = (old('is_robots_follow') === '0') ? 0 : 1;
    $flag_is_cornerstone    = (old('is_cornerstone') === '1') ? 1 : 0;
    $flag_schema_page    = (old('schema_page_type')) ? old('schema_page_type') : 'WebPage';

    $input_seo_main_info_id = '';
    
    if(!empty($item['id'])) {
        $input_seo_main_info_id = sprintf('<input type="hidden" name="seo_main_info_id" value="%s">', $item['seo_main_info_id']);
        $titleVal       = (old('title')) ? old('title') : $item['title'];
        $descriptionVal = (old('description')) ? old('description') : $item['description'];
        $keywordsVal    = (old('keywords')) ? old('keywords') : $item['keywords'];
        $canonicalVal   = (old('canonical')) ? old('canonical') : $item['canonical'];

        if(!old('meta_robots_adv')) {
            $noimageindex = ($item['is_robots_imageindex'] === 0) ? 'selected' : '';
            $noarchive = ($item['is_robots_archive'] === 0) ? 'selected' : '';
            $nosnippet = ($item['is_robots_snippet'] === 0) ? 'selected' : '';
        }
        if(!old('is_robots_index')) {
            $flag_robots_index = ($item['is_robots_index'] === 0) ? 0 : 1;
        }
        if(!old('is_robots_follow')) {
            $flag_robots_follow = ($item['is_robots_follow'] === 0) ? 0 : 1;
        }
        if(!old('is_cornerstone')) {
            $flag_is_cornerstone = ($item['is_cornerstone'] === 0) ? 0 : 1;
        }
        if(!old('main_keyword')) {
            $mainKeywordVal = (!empty($item['main_keyword'])) ? $item['main_keyword']['keyword'] : '';
        }
        if(!old('main_keyword_synonyms')) {
            $mainKeywordSynonymsVal = (!empty($item['main_keyword'])) ? $item['main_keyword']['keyword_synonyms'] : '';
        }
        if(!old('schema_page_type')) {
            $flag_schema_page = $item['schema_page_type'];
        }

        // Socail
        if(!old('open_graph_image')) {
            $openGraphImageVal = $item['open_graph_image'];
            $openGraphImagePrevewPreview = '<img src="'. $item['open_graph_image'] .'" width="100%" />';
        }
        if(!old('open_graph_image_id')) {
            $openGraphImageIdVal = $item['open_graph_image_id'];
        }
        if(!old('open_graph_title')) {
            $openGraphTitleVal = $item['open_graph_title'];
        }
        if(!old('open_graph_description')) {
            $openGraphDescriptionVal = $item['open_graph_description'];
        }
        if(!old('twitter_image')) {
            $metaTwitterImageVal = $item['twitter_image'];
            $imgTwitterPreview   = '<img src="'. $item['twitter_image'] .'" width="100%" />';
        }
        if(!old('twitter_image_id')) {
            $twitterImageIdVal = $item['twitter_image_id'];
        }
        if(!old('twitter_title')) {
            $metaTwitterTitleVal = $item['twitter_title'];
        }
        if(!old('twitter_description')) {
            $metaTwitterDescriptionVal = $item['twitter_description'];
        }
    }
@endphp
<div class="x_panel">
    <div class="x_title">
        <h3>SEO</h3>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <ul class="nav nav-tabs bar_tabs" id="seoTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general"
                    role="tab" aria-controls="general" aria-selected="true">Chung</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="focus_keywords-tab" data-toggle="tab" href="#focus_keywords" role="tab"
                    aria-controls="focus_keywords" aria-selected="false">Từ khóa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="schema-tab" data-toggle="tab" href="#schema" role="tab"
                    aria-controls="schema" aria-selected="false">Schema</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="socail-tab" data-toggle="tab" href="#socail" role="tab"
                    aria-controls="socail" aria-selected="false">Mạng xã hội</a>
            </li>
        </ul>
        <div class="tab-content" id="seoTabContent">
            <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                <p>
                    <label for="title">Thẻ title:</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{ $titleVal }}">
                </p>
                <p>
                    <label for="description">Thẻ mô tả:</label>
                    <textarea id="description" name="description" class="form-control">{{ $descriptionVal }}</textarea>
                </p>
                <p>
                    <label for="keywords">Thẻ keywords:</label>
                    <textarea id="keywords" name="keywords" class="form-control">{{ $keywordsVal }}</textarea>
                </p>
                <p>
                    <label>Cho phép máy tìm kiếm hiển thị Trang này trong kết quả tìm kiếm?</label>
                    @php
                        $arr_data_meta_robots = [
                            '1' => 'Có',
                            '0' => 'Không'
                        ];
                    @endphp
                    <select id="is_robots_index" name="is_robots_index" class="form-control">
                        @foreach ($arr_data_meta_robots as $key => $value)
                            @if ($flag_robots_index === (int)$key)
                            <option value="{{ $key }}" selected>{{ $value }}</option>
                            @else 
                            <option value="{{ $key }}" >{{ $value }}</option>
                            @endif
                        @endforeach
                    </select>
                </p>
                <p>
                    <label>Cho công cụ tìm kiếm theo dõi liên kết trên trang này?</label>
                    <p>
                        @php
                            // Truong hop 1: Nguoi dung chua tich => mac dinh se là 1: Có
                            // Trường hợp 2: Người dùng chọn sang không => đánh dấu 0
                            $arr_data_robots_follow = [
                                '1' => 'Có',
                                '0' => 'Không',
                            ] ;
                        @endphp
                         @foreach ($arr_data_robots_follow as $key => $value)
                            @if ($flag_robots_follow === (int)$key)
                            {{ $value }} <input type="radio" class="flat" name="is_robots_follow" value="{{ $key }}" checked />
                            @else 
                            {{ $value }} <input type="radio" class="flat" name="is_robots_follow" value="{{ $key }}" />
                            @endif
                        @endforeach
                    </p>
                </p>
                <p>
                    <label for="">Robots meta nâng cao</label>
                    <select class="select2_multiple form-control" name="meta_robots_adv[]" multiple="multiple">
                        <option value="noimageindex" {{ $noimageindex }}>Không có chỉ mục hình ảnh</option>
                        <option value="noarchive" {{ $noarchive }}>Không có lưu trữ</option>
                        <option value="nosnippet" {{ $nosnippet }}>Không có đoạn trích ngắn</option>
                    </select>
                </p>
                <p>
                    <label for="canonical">Canonical URL:</label>
                    <input type="text" id="canonical" class="form-control" name="canonical" value="{{ $canonicalVal }}">
                </p>
                <p>
                    <label>Nội dung quan trọng?</label>
                    <p>
                        @php
                            $arr_data_is_cornerstone = [
                                '1' => 'Có',
                                '0' => 'Không',
                            ] ;
                        @endphp
                         @foreach ($arr_data_is_cornerstone as $key => $value)
                            @if ($flag_is_cornerstone === (int)$key)
                            {{ $value }} <input type="radio" class="flat" name="is_cornerstone" value="{{ $key }}" checked />
                            @else 
                            {{ $value }} <input type="radio" class="flat" name="is_cornerstone" value="{{ $key }}" />
                            @endif
                        @endforeach
                    </p>
                </p>
            </div>
            <div class="tab-pane fade" id="focus_keywords" role="tabpanel" aria-labelledby="focus_keywords-tab">
                <p>
                    <label for="main_keyword">Từ khóa chính:</label>
                    {!! $input_seo_main_info_id !!}
                    <input type="text" id="main_keyword" class="form-control" name="main_keyword" value="{{ $mainKeywordVal }}">
                </p>
                <p>
                    <label for="main_keyword_synonyms">Từ khóa đồng nghĩa với từ khóa chính:</label>
                    <input type="text" id="main_keyword_synonyms" class="form-control" name="main_keyword_synonyms" value="{{ $mainKeywordSynonymsVal }}">
                </p>
                <div class="accordion" id="accordion_keyword" role="tablist" aria-multiselectable="true">
                    @if (old('focus_keywords')) 
                    @for ($i = 1; $i <= count(old('focus_keywords')); $i++)   
                    @php
                        $focus_keywords = old('focus_keywords');
                        $focus_keywords_synonyms = old('focus_keywords_synonyms');
                    @endphp    
                    <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="heading{{ $i }}" data-toggle="collapse" data-parent="#accordion_keyword" href="#collapse{{ $i }}" aria-expanded="false" aria-controls="collapse{{ $i }}">
                            <h4 class="panel-title">Từ khóa liên quan #{{ $i }}</h4>
                        </a>
                        <div id="collapse{{ $i }}" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="heading{{ $i }}">
                            <div class="panel-body">
                                <p>
                                    <label>Từ khóa liên quan:</label>
                                    <input type="text" class="form-control" name="focus_keywords[]" value="{{ $focus_keywords[$i - 1] }}">
                                </p>
                                <p>
                                    <label>Từ khóa đồng nghĩa với từ khóa liên quan:</label>
                                    <input type="text" class="form-control" name="focus_keywords_synonyms[]" value="{{ $focus_keywords_synonyms[$i - 1] }}">
                                </p>
                            </div>
                        </div>
                    </div>
                    @endfor
                    @elseif(!empty($item['id']) && !empty($item['focus_keywords']) )
                    @for ($i = 1; $i <= count($item['focus_keywords']); $i++)   
                    @php
                        $focus_keywords = $item['focus_keywords'][$i-1]['focus_keywords'];
                        $focus_keywords_synonyms = $item['focus_keywords'][$i-1]['focus_keywords_synonyms'];
                    @endphp    
                    <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="heading{{ $i }}" data-toggle="collapse" data-parent="#accordion_keyword" href="#collapse{{ $i }}" aria-expanded="false" aria-controls="collapse{{ $i }}">
                            <h4 class="panel-title">Từ khóa liên quan #{{ $i }}</h4>
                        </a>
                        <div id="collapse{{ $i }}" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="heading{{ $i }}">
                            <div class="panel-body">
                                <p>
                                    <label>Từ khóa liên quan:</label>
                                    <input type="text" class="form-control" name="focus_keywords[]" value="{{ $focus_keywords }}">
                                </p>
                                <p>
                                    <label>Từ khóa đồng nghĩa với từ khóa liên quan:</label>
                                    <input type="text" class="form-control" name="focus_keywords_synonyms[]" value="{{ $focus_keywords_synonyms }}">
                                </p>
                            </div>
                        </div>
                    </div>
                    @endfor
                    @endif
                </div>
                <label class="btn btn-success" id="add_focus_keywords" style="cursor:pointer;">Thêm từ khóa liên quan</label>
            </div>
            <div class="tab-pane fade" id="schema" role="tabpanel" aria-labelledby="schema-tab">
                <p>
                    <label>Loại trang hoặc nội dung này là gì?</label>
                    @php
                        $arr_data_schema_page = [
                            'WebPage' => 'Trang Web',
                            'ItemPage' => 'Trang sản phẩm',
                            'AboutPage' => 'Trang giới thiệu',
                            'FAQPage' => 'Trang hỗ trợ',
                            'QAPage' => 'Trang hỏi-đáp',
                            'ProfilePage' => 'Trang cá nhân',
                            'ContactPage' => 'Trang liên hệ',
                            'MedicalWebPage' => 'Trang web y tế',
                            'CollectionPage' => 'Trang Bộ sưu tập',
                            'CheckoutPage' => 'Trang thanh toán',
                            'RealEstateListing' => 'Danh sách bất động sản',
                            'SearchResultsPage' => 'Trang kết quả tìm kiếm',
                        ];
                    @endphp
                    <select name="schema_page_type" class="form-control">
                        @foreach ($arr_data_schema_page as $key => $value)
                            @if ($flag_schema_page === $key)
                            <option value="{{ $key }}" selected>{{ $value }}</option>
                            @else 
                            <option value="{{ $key }}" >{{ $value }}</option>
                            @endif
                        @endforeach
                    </select>
                </p>
            </div>
            <div class="tab-pane fade" id="socail" role="tabpanel" aria-labelledby="socail-tab">
                <label>Ảnh xem trước Facebook</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="open_graph_image" name="open_graph_image" value="{{ $openGraphImageVal }}">
                    <input type="hidden" name="open_graph_image_id" id="open_graph_image_id" value="{{ $openGraphImageIdVal }}">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary" onclick="media_show('open_graph_image', 'open_graph_image_prevew', 'open_graph_image_id')">Chọn!</button>
                    </span>
                </div>
                <div id="open_graph_image_prevew" style="margin-bottom:10px;">{!! $openGraphImagePrevewPreview !!}</div>
                <p>
                    <label for="heard">Facebook Title:</label>
                    <input type="text" id="open_graph_title" class="form-control" name="open_graph_title" value="{{ $openGraphTitleVal }}">
                </p>
                <p>
                    <label for="heard">Facebook mô tả:</label>
                    <textarea id="open_graph_description" name="open_graph_description" class="form-control">{{ $openGraphDescriptionVal }}</textarea>
                </p>
                <label>Ảnh xem trước Twitter</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="twitter_image" name="twitter_image" value="{{ $metaTwitterImageVal }}">
                    <input type="hidden" name="twitter_image_id" id="twitter_image_id" value="{{ $twitterImageIdVal }}">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary" onclick="media_show('twitter_image', 'twitter_image_prevew', 'twitter_image_id')">Chọn!</button>
                    </span>
                </div>
                <div id="twitter_image_prevew" style="margin-bottom:10px;">{!! $imgTwitterPreview !!}</div>
                <p>
                    <label for="heard">Twitter Title:</label>
                    <input type="text" id="twitter_title" class="form-control" name="twitter_title" value="{{ $metaTwitterTitleVal }}">
                </p>
                <p>
                    <label for="heard">Twitter mô tả:</label>
                    <textarea id="twitter_description" name="twitter_description" class="form-control">{{ $metaTwitterDescriptionVal }}</textarea>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', event => {
        const add_focus_keywords = document.getElementById('add_focus_keywords');
        add_focus_keywords.onclick = () => {
            const accordion_keyword = document.getElementById('accordion_keyword');
            const numberChild = accordion_keyword.childElementCount;
            let html = '';
            const numberNew = numberChild + 1;
            html = `<div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="heading${numberNew}" data-toggle="collapse" data-parent="#accordion_keyword" href="#collapse${numberNew}" aria-expanded="false" aria-controls="collapse${numberNew}">
                            <h4 class="panel-title">Từ khóa liên quan #${numberNew}</h4>
                        </a>
                        <div id="collapse${numberNew}" class="panel-collapse in collapse" role="tabpane${numberNew}" aria-labelledby="heading${numberNew}" style="">
                            <div class="panel-body">
                                <p>
                                    <label>Từ khóa liên quan:</label>
                                    <input type="text" class="form-control" name="focus_keywords[]" value="">
                                </p>
                                <p>
                                    <label>Từ khóa đồng nghĩa với từ khóa liên quan:</label>
                                    <input type="text" class="form-control" name="focus_keywords_synonyms[]" value="">
                                </p>
                            </div>
                        </div>
                    </div>`;
            nodeHtml = document.createRange().createContextualFragment(html);
            accordion_keyword.appendChild(nodeHtml);
        }
    })
</script>