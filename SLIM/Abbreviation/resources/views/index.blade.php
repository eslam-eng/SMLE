@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">

                    <div class="col" style="margin-left:1170px">
                        <h2 class="page-title">
                            <a class="btn btn-danger" href="#" data-bs-toggle="modal"
                               data-bs-target="#modal-add-category">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                    </path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Add New abbreviation
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
                    <h3>Abbreviations Page</h3>
                    <div class="col-12">
                        <form class="card">
                            <div class="card-body">
                                <h3 class="card-title">Filter Abbreviation</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Abbreviations Chars</label>
                                            <input type="text" class="form-control" placeholder="Abbreviations Chars"
                                                   id="chars">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Abbreviations Words</label>
                                            <input type="text" class="form-control" placeholder="Abbreviations Words"
                                                   id="words">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Is Active</label>
                                            <select class="form-select" name="is_active" id="status">
                                                <option selected value=""> select status</option>
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end p-1">
                                <button type="button" class="btn btn-success" id="searchBtn">Search</button>
                                <button type="reset" class="btn btn-secondary" id="Resetsearch">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <a href="{{route('export.abbreviation')}}" role="button" class="btn btn-info ms-2"><i class="fa fa-download"></i>Export Data</a>
                            <a href="{{route('abbreviation.download-template')}}" role="button" class="btn btn-info ms-2"><i class="fa fa-download"></i>download Empty Template</a>
                            <a role="button" class="btn btn-warning ms-2"><i class="fa fa-upload"></i>import</a>
                        </div>
                        <div class="table-responsive">
                            @include('abbreviation::partial')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    @include('abbreviation::edit')
    @include('abbreviation::create')

@endsection
@push('js')
    <script src="{{Module::asset('abbreviation:js/app.js')}}" defer></script>
@endpush
