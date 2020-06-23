<!DOCTYPE html>
<?php

?>
<html lang="en" data-textdirection="ltr">
<head>
        @include('layout.partials.head')
</head>

<body class="content-left-sidebar chat-application  fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" >

    @include('layout.partials.navbarheader')

    @include('layout.partials.sidebar')

    @yield('content')

    @include('layout.partials.footer')

    @include('layout.partials.footer-scripts')
</body>
</html>