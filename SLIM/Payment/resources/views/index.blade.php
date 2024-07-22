@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">

                <div class="col" style="margin-left:1170px">
                    <h2 class="page-title">
                        <a  class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#modal-add-payment">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none">
                                </path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                   Add New Payment Method
                        </a>
                    </h2>

                </div>
            </div>

        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

            <h5>Payment Page</h5>
                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            @include('payment::partial')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@include('payment::edit')
@include('payment::create')

@endsection
@push('js')
    <script src="{{Module::asset('payment:js/app.js')}}" defer></script>
@endpush
