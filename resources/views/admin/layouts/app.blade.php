<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    @include('admin.layouts.header')
</head>
<body class="h-100">
<div class="container-fluid">
    <div class="row">
        @include('admin.layouts.sidebar')
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            @include('admin.layouts.main-navbar')
            <div class="main-content-container container-fluid px-4">
                @yield('content')
            </div>
        </main>
    </div>
</div>
@include('admin.layouts.footer')
@yield('scripts')

</body>
</html>
