@extends('admin::layouts.index')
@section('content')
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
                    <div class="col-12">
                        <form class="card" id="createForm">
                            @csrf
                            <div class="card-body">
                                <h3 class="card-title">Add New Subscribe</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Trainee Name</label>
                                                <select class="form-select" name="trainee_id" id="traineeId">
                                                    <option disabled="disabled" selected> select Trainee Name</option>
                                                     @foreach($trainees as $index => $trainee)
                                                         <option value="{{$trainee->id}}">{{$trainee->full_name}}</option>
                                                         @endforeach
                                                </select>
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Package Name</label>
                                            <select class="form-select amount" name="package_id" id="packageId">
                                                <option disabled="disabled" selected value=""> Select Package</option>
                                                @foreach($packages  as $index => $package)
                                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Amount</label>
                                            <input type="text" class="form-control" name="amount" id="amount" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Subscribe Type</label>
                                            <select class="form-select amount" name="package_type" id="package_type">
                                                <option disabled="disabled" selected value=""> select Type</option>
                                                <option value="m">Monthly</option>
                                                <option value="y">Yearly</option>
                                                <option value="p">Permanent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-select" name="payment_method" id="payment_method">
                                                <option disabled="disabled" selected> select Type</option>
                                                @foreach($payments as $payment)
                                                <option value="{{$payment->name}}">{{$payment->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Is Active</label>
                                            <select class="form-select" name="is_active" id="is_active">
                                                <option disabled="disabled" selected> select status</option>

                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" id="StartDate">Start Date</label>
                                            <input type="date" class="form-control startDate" name="start_date" placeholder="Start Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">End Date</label>
                                            <input type="date" readonly class="form-control" name="end_date" placeholder="End Date" id="endDate">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Invoice</label>
                                            <input type="file"class="form-control" name="invoice">
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>

@endsection
@push('js')
    <script src="{{Module::asset('subscribe:js/app.js')}}" defer></script>
@endpush
