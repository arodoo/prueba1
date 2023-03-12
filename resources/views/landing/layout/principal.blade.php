<!DOCTYPE html>
<html lang="en">

<head>
    @include('landing.include.head')
</head>

<body id="page-top">
    <!--Navigation-->
    <!--<a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">-->

    @include('landing.include.menu')

    <!--Section-->

    <body class="body-space">
        @yield('contenido')
    </body>
    <!--Footer-->
    <footer class="footer text-center color11">
        @include('landing.include.footer')
    </footer>
    <!--Scripts-->
    @include('landing.include.script')
</body>

</html>
