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
                        <form class="card" id="updateForm" action="{{route('subscribe-trainee.update',$subscribe->id)}}">
                            @csrf
                            <div class="card-body">
                                <h3 class="card-title">Update Subscribe</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Trainee Name</label>
                                            <select class="form-select" name="trainee_id" id="traineeId">
                                                <option disabled="disabled" selected> select Trainee Name</option>
                                                @foreach($trainees as $index => $trainee)
                                                    <option value="{{$trainee->id}}" {{$subscribe->id == $trainee->id ?'selected':'' }} >{{$trainee->full_name}}</option>
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
                                                    <option value="{{$package->id}}" {{$subscribe['packages'][0]['pivot']['package_id'] == $package->id ?'selected':'' }}>{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Amount</label>
                                            <input type="text" class="form-control" name="amount" id="amount" readonly value="{{$subscribe['packages'][0]['pivot']['amount']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Subscribe Type</label>
                                            <select class="form-select amount" name="package_type" id="package_type">
                                                <option disabled="disabled" selected value=""> select Type</option>
                                                <option value="m" {{$subscribe['packages'][0]['pivot']['package_type'] == 'm' ?'selected' :''}}>Monthly</option>
                                                <option value="y" {{$subscribe['packages'][0]['pivot']['package_type'] == 'y' ?'selected' :''}}>Yearly</option>
                                                <option value="p" {{$subscribe['packages'][0]['pivot']['package_type'] == 'p' ?'selected' :''}}>Permanent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-select" name="payment_method" id="payment_method">
                                                <option disabled="disabled" selected> select Type</option>
                                                @foreach($payments as $payment)
                                                    <option value="{{$payment->name}}"  {{$subscribe['packages'][0]['pivot']['payment_method'] == $payment->name ?'selected' :''}}>{{$payment->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Is Active</label>
                                            <select class="form-select" name="is_active" id="is_active">
                                                <option disabled="disabled" selected> select status</option>

                                                <option value="1" {{$subscribe['packages'][0]['pivot']['is_active'] ==1 ?'selected' :''}}>Active</option>
                                                <option value="0" {{$subscribe['packages'][0]['pivot']['is_active'] ==0 ?'selected' :''}}>InActive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" id="StartDate">Start Date</label>
                                            <input type="date" class="form-control startDate" name="start_date" placeholder="Start Date" value="{{$subscribe['packages'][0]['pivot']['start_date']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">End Date</label>
                                            <input type="date" readonly class="form-control" name="end_date" placeholder="End Date" id="endDate" value="{{$subscribe['packages'][0]['pivot']['end_date']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Purchase Invoice</label>
                                            <input type="file"class="form-control" name="invoice">
                                            <br>
                                            @if(!is_null($subscribe['packages'][0]['pivot']['invoice_file']))
                                            <a href="{{url($subscribe['packages'][0]['pivot']['invoice_file'])}}" download="">Download</a>
                                        @endif
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-danger" id="btnSubmit">update</button>
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
