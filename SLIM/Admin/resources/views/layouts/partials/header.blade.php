<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" type="image/x-icon" href="{{asset('storage/'.$setting->website_icon)}}">

    <title>{{$setting->app_name}}</title>
    <!-- CSS files -->
    <link href="{{Module::asset('admin:css/tabler.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{Module::asset('admin:css/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{Module::asset('admin:css/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{Module::asset('admin:css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{Module::asset('admin:css/demo.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('custom-css')
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
        .flex justify-between{
            display:none;
        }
        .modal-footer > a{
            color:white !important;
        }
        #circle {
            padding: 0;
            background-color: #40a977;
            border-radius: 50%;
            float: left;

            font-size: 44px;
            line-height: 16px;
        }
        input[type="checkbox"] {
            cursor: pointer;
        }

    </style>
</head>
