<!doctype html>

<html lang="en">
@include('admin::layouts.partials.header')
<body >
<script src="{{Module::asset('admin:js/demo-theme.min.js?1692870487')}}"></script>



<div class="page">
    <!-- Sidebar -->

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">

                </div>

            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <form class="card" id="LoginForm">
                    <div class="col-12">
                            @csrf
                          <div class="col-xl-4"></div>
                          <div class="col-xl-4">
                       <div class="row">
                        <div class="col-md-6 col-xl-12">
                            <label class="form-label">Login</label>
                            <fieldset class="form-fieldset">
                                <div class="mb-3">
                                    <label class="form-label required">E-mail</label>
                                    <input type="email" class="form-control" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Password</label>
                                    <input type="password" class="form-control" autocomplete="off">
                                </div>
                            </fieldset>
                        </div>
                    </div>
    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin::layouts.partials.footer')

@include('admin::layouts.partials.scripts')



</body>
</html>


