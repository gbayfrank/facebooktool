@php
    $totalItems         = $items->total();
    $totalPage          = $items->lastPage();
    $totalItemsPerPage  = $items->perPage();
@endphp
<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            <p class="m-b-0">
                Số phần tử trên 1 trang: <span class="label label-info label-pagination">{{ $totalItemsPerPage }} trang</span>
            </p>
            <p class="m-b-0">
                Tổng số phần tử: <span class="label label-success label-pagination">{{ $totalItems }} trang</span>
                Số trang: <span class="label label-danger label-pagination">{{ $totalPage }} trang</span>
            </p>
        </div>
        <div class="col-md-6">
            {!! $items->appends(request()->input())->links('pagination.link_pagination_backend') !!}
        </div>
    </div>
</div>