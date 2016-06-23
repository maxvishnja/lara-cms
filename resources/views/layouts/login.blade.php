<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @section('title')
        @show
    </title>
    @include('layouts/blocks.head')
</head>

<body class="login">
<div class="login_wrapper">
    @include('layouts.notifications')
    @yield('content')
</div>
@include('layouts/blocks.footer')
</body>
</html>