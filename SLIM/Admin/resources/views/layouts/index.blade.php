<!doctype html>

<html lang="en">
     @include('admin::layouts.partials.header')
<body >
<script src="{{Module::asset('admin:js/demo-theme.min.js?1692870487')}}"></script>



<div class="page">
    <!-- Sidebar -->
       @include('admin::layouts.partials.sidebar')

           @yield('content')



</div>
@include('admin::layouts.partials.footer')

@include('admin::layouts.partials.scripts')



</body>
</html>
