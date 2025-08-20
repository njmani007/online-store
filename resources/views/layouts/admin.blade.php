<!DOCTYPE html>
<html>

<head>
    <title>Admin - {{ $title ?? '' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

</head>

<body>
    @include('partials.admin-header')

    <div class="container-fluid">
        <div class="row g-0" style="height: calc(100vh - 56px);"> <!-- 56px for navbar height -->
            <div class="col-md-2 p-3 bg-white shadow-sm h-100 overflow-auto">
                @include('partials.admin-sidebar')
            </div>

            <div class="col-md-10 p-2 bg-body-light h-100 overflow-auto">
                @yield('content')
            </div>
        </div>
    </div>
    {{-- @include('partials.footer') --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>

</html>
