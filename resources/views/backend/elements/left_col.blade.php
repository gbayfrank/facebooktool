@php
    $prefixAdmin = Config::get('gbayvn.url.prefix_admin', 'gbay');
@endphp
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gbay Admin!</span></a>
        </div>
        <div class="clearfix"></div>

        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('/images/avatars/img.jpg') }}" alt="avatar" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Chào bạn</span>
                <h2>Gbay Frank</h2>
            </div>
        </div>
        <br />
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i>Dashboard 
                        </a>
                    </li>
                    <li><a><i class="fa fa-cube"></i> Sản phẩm <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route( $prefixAdmin . '.products' ) }}">Tất cả sản phẩm</a></li>
                            <li><a href="{{ route( $prefixAdmin . '.products' ) }}">Thêm mới sản phẩm</a></li>
                            <li><a href="#">Danh mục</a></li>
                            <li><a href="#">Thương hiệu</a></li>
                            <li><a href="#">Thuộc tính</a></li>
                            <li><a href="#">Bộ thuộc tính</a></li>
                            <li><a href="#">Tùy chọn</a></li>
                            <li><a href="#">Thẻ</a></li>
                            <li><a href="#">Đánh giá</a></li>
                        </ul>
                    </li> 
                    <li><a><i class="fa fa-pencil"></i> Bài viết <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Tất cả bài viết</a></li>
                            <li><a href="#">Viết bài mới</a></li>
                            <li><a href="#">Chuyên mục</a></li>
                            <li><a href="#">Thẻ</a></li>
                            <li><a href="#">Bình luận</a></li>
                        </ul>
                    </li> 
                    <li><a><i class="fa fa-usd"></i> Bán hàng <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Đơn hàng</a></li>
                            <li><a href="#">Giao dịch</a></li>
                        </ul>
                    </li>  
                    <li>
                        <a href="#">
                            <i class="fa fa-bolt"></i>Bán nhanh
                        </a>
                    </li> 
                    <li>
                        <a href="#">
                            <i class="fa fa-tags"></i>Mã giảm giá 
                        </a>
                    </li>
                    <li><a><i class="fa fa-fire"></i> Khách hàng <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Tất cả khách hàng</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-image"></i> Media <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route( $prefixAdmin . '.uploads' ) }}">Thư viện</a></li>
                            <li><a href="{{ route( $prefixAdmin . '.uploads.new' ) }}">Tải lên</a></li>
                        </ul>
                    </li>  
                    <li><a><i class="fa fa-file-o"></i> Trang <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route( $prefixAdmin . '.pages' ) }}">Tất cả các trang</a></li>
                            <li><a href="{{ route( $prefixAdmin . '.pages.form' ) }}">Thêm trang mới</a></li>
                        </ul>
                    </li> 
                    <li><a><i class="fa fa-home"></i> Theme <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route( $prefixAdmin . '.sliders' ) }}">Sliders</a></li>
                            <li><a href="index2.html">Menu</a></li>
                            <li><a href="index3.html">Cài đặt theme</a></li>
                        </ul>
                    </li>    
                    <li><a><i class="fa fa-user"></i> Thành viên <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Tất cả thành viên</a></li>
                            <li><a href="index2.html">Phân quyền</a></li>
                        </ul>
                    </li>   
                    <li>
                        <a href="#">
                            <i class="fa fa-bar-chart"></i>Báo cáo 
                        </a>
                    </li>  
                    <li>
                        <a href="#">
                            <i class="fa fa-cog"></i>Cài đặt
                        </a>
                    </li>        
                </ul>
            </div>            
        </div>
    </div>
</div>