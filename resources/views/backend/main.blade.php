<!DOCTYPE html>
<html lang="vi">
<head>
    @include('backend.elements.head')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('backend.elements.left_col')
            @include('backend.elements.top_nav')

            @yield('content')
            @include('backend.elements.footer')
        </div>
    </div>
    @include('backend.elements.script')
</body>
</html>
