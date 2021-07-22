@if ($paginator->hasPages())
@php
    $search_url = '';
    if(!empty($_GET)) {
        foreach ($_GET as $key => $value) {
            if($key === 'page') continue;
            $search_url .= '&' . $key . '=' . $value;
        }
    }
@endphp
<div class="footer">
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="gbay_table_info">Hiển thị từ {{ $paginator->firstItem() }} tới {{ $paginator->lastItem() }} của {{ $paginator->total() }} phần tử</div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="gbay_paginate paging_simple_numbers">
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    @if ($paginator->onFirstPage())
                        <li class="paginate_button disabled"><span>&laquo;</span></li>
                    @else
                        <li class="paginate_button previous"><a href="{{ $paginator->previousPageUrl() . $search_url }}" rel="prev">&laquo;</a></li>
                    @endif
                
                    <!-- Pagination Elements -->
                    @foreach ($elements as $element)
                        <!-- "Three Dots" Separator -->
                        @if (is_string($element))
                            <li class="paginate_button disabled"><span>{{ $element }}</span></li>
                        @endif
                
                        <!-- Array Of Links -->
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="paginate_button active"><span>{{ $page }}</span></li>
                                @else
                                    <li class="paginate_button"><a href="{{ $url . $search_url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                
                    <!-- Next Page Link -->
                    @if ($paginator->hasMorePages())
                        <li class="paginate_button next"><a href="{{ $paginator->nextPageUrl() . $search_url }}" rel="next">&raquo;</a></li>
                    @else
                        <li class="paginate_button disabled"><span>&raquo;</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endif