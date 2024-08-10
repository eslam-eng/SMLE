@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">

                <div class="col" style="margin-left:1170px">
                    <h2 class="page-title">
                        <a  class="btn btn-danger" href="{{route('trainee.create')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none">
                                </path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                                   Add New Trainee
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
                <h5>Trainees Page</h5>

                <div class="col-12">
                    <form class="card">
                        <div class="card-body">
                            <h3 class="card-title">Filter Trainees</h3>
                            <div class="row row-cards">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Trainee Name</label>
                                        <input type="text" class="form-control" placeholder="Full Name" id="full_name">
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
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" placeholder="Phone" id="phone">
                                    </div>
                                </div>
{{--                                <div class="col-md-4">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label">specialization</label>--}}
{{--                                        <select class="form-control specialization" name="specialist_id" id="specialist_id">--}}
{{--                                            <option disabled="disabled" selected> select specialist</option>--}}
{{--                                            @foreach($specializations as $specialization)--}}
{{--                                                <option value="{{$specialization->id}}">{{$specialization->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Educational Degree</label>
                                        <select class="form-control" name="degree" id="degree">
                                            <option disabled="disabled" selected>select Degree</option>
                                            <option value="Student">Student</option>
                                            <option value="Bachelor">Bachelor</option>
                                            <option value="Master">Master</option>
                                            <option value="Doctorate">Doctorate</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{route('trainee.export')}}" class="btn btn-info"><i class="fa fa-download"></i>Export</a>
                            <button type="submit" class="btn btn-dark" id="searchBtn">Search</button>
                            <button type="reset" class="btn btn-default" id="Resetsearch">Reset</button>
                        </div>
                    </form>
                </div>
                </div>


                <div class="col-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <div class="table-responsive">
                            @include('trainee::partial')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>


@endsection
@push('js')
    <script src="{{Module::asset('trainee:js/app.js')}}" defer></script>
@endpush
