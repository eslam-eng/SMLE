@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">

                <div class="row g-2 align-items-center">

                    <div class="col" style="margin-left:831px">
                        <h2 class="page-title">
                            <a class="btn btn-danger" href="{{route('subscribe-trainee.create')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Add New Subscribe
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
                    <div class="col-12">
                        <form class="card">
                            <div class="card-body">
                                <h3 class="card-title">Filter Subscriptions</h3>
                                <div class="row row-cards">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Trainee Name</label>
                                            <select class="form-select" name="trainee_id" id="trainee_id">
                                                <option selected value="">Select Package</option>
                                                @foreach($trainees as $trainee)
                                                    <option value="{{$trainee->id}}">{{$trainee->full_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Package Name</label>
                                            <select class="form-select" name="package_id" id="package_id">
                                                <option selected value="">Select Package</option>
                                                @foreach($packages  as $package)
                                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Is Active</label>
                                            <select class="form-select" name="is_active" id="is_active">
                                                <option selected value=""> select status</option>
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-select" name="payment" id="payment">
                                                <option selected value="">Select Method</option>
                                                @foreach($payments as $payment)
                                                    <option value="{{$payment->name}}">{{$payment->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-select" name="is_paid" id="is_paid">
                                                <option selected value="">Select Status</option>
                                                <option value="1">Paid</option>
                                                <option value="0">Not Paid</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Subscribe Type</label>
                                            <select class="form-select" name="package_type" id="package_type">
                                                <option selected value="">Select Type</option>
                                                <option value="m">Monthly</option>
                                                <option value="y">Yearly</option>
                                                <option value="p">Permanent</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="reset" class="btn btn-secondary" id="ResetSearch">Reset</button>
                                <button type="submit" class="btn btn-success" id="searchBtn">Search</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                        @endif
                        @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('error')}}
                                </div>
                        @endif
                        <div class="table-responsive">
                            @include('trainee::subscribe.partial')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
<div class="modal modal-blur fade" id="modal-large" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">invoice file</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_content">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{Module::asset('subscribe:js/app.js')}}" defer></script>
@endpush
