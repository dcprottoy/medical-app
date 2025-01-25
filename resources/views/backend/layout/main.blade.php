@include('backend.layout.header')
<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        @include('backend.layout.navbar')
        @include('backend.layout.sidebar')



            @yield('body-part')



        @include('backend.layout.rightsidebar')
        @include('backend.layout.footer')
    </div>
    @include('backend.layout.footerscript')
