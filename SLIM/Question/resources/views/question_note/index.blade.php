@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">

            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <h5>Questions Notes Page</h5>
                    <div class="col-12">
                        <form class="card">
                            <div class="card-body">
                                <h3 class="card-title">Filter Question note</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Question #</label>
                                            <input type="text" class="form-control" placeholder="Question #"
                                                id="question_id">
                                        </div>
                                    </div>
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
                                            <select class="form-control sub_specialization" name="sub_specialist_id"
                                                    id="sub_specialist_id">
                                                <option class="select_sub_specialist"  selected value=""> select Sub specialist
                                                </option>
                                                @foreach ($sub_specializations as $sub_specialization)
                                                    <option class="d-none {{$sub_specialization->specialist_id}}" value="{{ $sub_specialization->id }}">
                                                        {{ $sub_specialization->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" placeholder="Full Name"
                                                name="full_name" id="full_name">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="text" class="form-control" placeholder="E-mail" id="email"
                                                name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" placeholder="Phone" id="phone"
                                                name="phone">
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
                            @include('question::question_note.partial')

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
    <script src="{{ Module::asset('question_note:js/app.js') }}" defer></script>
@endpush
