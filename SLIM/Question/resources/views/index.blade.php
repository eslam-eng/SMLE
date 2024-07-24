@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">

                    <div class="col" style="margin-left:1170px">
                        <h2 class="page-title">
                            <a class="btn btn-danger" href="{{ route('question.create') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Add New Question
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
                    <h5>Questions Page</h5>
                    <div class="col-12">
                        <form class="card">
                            <div class="card-body">
                                <h3 class="card-title">Filter Questions</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <input type="text" class="form-control" placeholder="Question title"
                                                id="question">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">specialisation</label>
                                            <select class="form-control specialization" name="specialist_id"
                                                id="specialist_id">
                                                <option disabled="disabled" selected value=""> select specialist
                                                </option>
                                                @foreach ($specializations as $specialization)
                                                    <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">sub specializations</label>
                                            <select class="form-control specialization sub-specialization" name="sub_specialist_id"
                                                id="sub_specialist_id">
                                                <option class="select_sub_specialist" selected value=""> select Sub specialist</option>
                                                @foreach ($sub_specializations as $sub_specialization)
                                                    <option class="{{$sub_specialization->specialist_id}} d-none" value="{{ $sub_specialization->id }}">
                                                        {{ $sub_specialization->name }}</option>
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
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-dark" id="searchBtn">Search</button>
                                <button type="reset" class="btn btn-default" id="Resetsearch">Reset</button>

                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            @include('question::partial')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
    <script src="{{ Module::asset('question:js/app.js') }}" defer></script>
@endpush
