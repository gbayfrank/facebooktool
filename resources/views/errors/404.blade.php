@extends('fontend.main')
@section('content')
<div class="block">
    <div class="container">
        <div class="not-found">
            <div class="not-found__404">Oops! Lỗi 404</div>
            <div class="not-found__content">
                <h1 class="not-found__title">Trang không tồn tại</h1>
                <p class="not-found__text">Chúng tôi dường như không thể tìm thấy trang bạn đang tìm. <br>Hãy thử sử dụng tìm kiếm.</p>
                <form class="not-found__search">
                    <input type="text" class="not-found__search-input form-control" placeholder="Bạn muốn tìm gì..."> 
                    <button type="submit" class="not-found__search-button btn btn-primary">Tìm</button>
                </form>
                <p class="not-found__text">Hoặc quay lại trang chủ để tiếp tục.</p>
                <a class="btn btn-secondary btn-sm" href="index.html">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>
@endsection
