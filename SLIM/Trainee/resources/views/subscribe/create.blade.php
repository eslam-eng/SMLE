@extends('admin::layouts.index')
@section('custom-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
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
                                            <select class="form-select amount" name="package_id" id="packageId" required>
                                                <option disabled="disabled" selected value=""> Select Package</option>
                                                @foreach($packages  as $index => $package)
                                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Subscribe Type</label>
                                            <select class="form-select amount" name="package_type" id="package_type">
                                                <option disabled="disabled" selected value=""> select Type</option>
                                                <option value="m">Monthly</option>
                                                <option value="y">Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-select" name="payment_method" id="payment_method">
                                                @foreach($paymentMethods as $paymentMethod)
                                                    <option value="{{$paymentMethod->id}}" selected>{{$paymentMethod->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Is Active</label>
                                            <select class="form-select" name="is_active" id="is_active">
                                                <option value="1" selected>Active</option>
                                                <option value="0">InActive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" id="StartDate">Start Date</label>
                                            <input type="date" class="form-control startDate" name="start_date" readonly
                                                   placeholder="Start Date" value="{{now()->format('Y-m-d')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">End Date</label>
                                            <input type="date" class="form-control" name="end_date"
                                                   placeholder="End Date" id="endDate" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">specialists</label>
                                            <select id="specialists" class="js-example-basic-single form-select" name="specialists[]" multiple>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Amount</label>
                                            <input type="text" class="form-control" name="amount" id="amount" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Invoice</label>
                                            <input type="file" class="form-control" name="invoice" required>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.js-example-basic-single').select2({
            placeholder: 'select specialists',
            multiple:true,
            tags: "true",
        });
    </script>
@endpush
