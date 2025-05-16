<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laravel Distro PointSurf')</title>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        @yield('content')
    </div>
</body>
</html>