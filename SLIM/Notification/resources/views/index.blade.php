@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">

                <div class="col" style="margin-left:1170px">
                    <h2 class="page-title">
                        <a  class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#modal-add-notification">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none">
                                </path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                   Add New Notification
                        </a>
                    </h2>

                </div>
            </div>

        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <h5>Message Page</h5>

                <div class="col-12">
{{--                    <form class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <h3 class="card-title">Filter Category</h3>--}}
{{--                            <div class="row row-cards">--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label">Name</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Name" id="category_name">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label">Color</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="Name" id="category_color">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label">Is Active</label>--}}
{{--                                        <select class="form-select" name="is_active" id="status">--}}
{{--                                            <option value="1">Active</option>--}}
{{--                                            <option value="0">InActive</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-footer text-end">--}}
{{--                            <button type="submit" class="btn btn-dark" id="searchBtn">Search</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                </div>
                </div>


                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            @include('notification::partial')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@include('notification::edit')
@include('notification::create')

@endsection
@push('js')
    <script src="{{Module::asset('notification:js/app.js')}}" defer></script>
@endpush
