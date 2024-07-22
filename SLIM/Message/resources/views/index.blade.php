@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">

                <div class="col" style="margin-left:831px">
                    <h2 class="page-title">
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
                    <form class="card">
                        <div class="card-body">
                            <h3 class="card-title">Filter Message</h3>
                            <div class="row row-cards">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" placeholder="Name" id="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control" placeholder="E-mail" id="email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">phone</label>
                                        <input type="text" class="form-control" placeholder="Phone" id="phone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status">
                                            <option value="" selected  >select status</option>
                                            <option value="1">Read</option>
                                            <option value="0">unRead</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="reset" class="btn btn-default" id="Resetsearch">Reset</button>
                            <button type="submit" class="btn btn-dark" id="searchBtn">Search</button>
                        </div>
                    </form>
                </div>
                </div>


                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            @include('message::partial')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{Module::asset('messages:js/app.js')}}" defer></script>
@endpush
