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
                                <h3 class="card-title">Add New Package</h3>
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Package Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Package Name">
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Monthly Price for all specialities</label>
                                            <input type="number" class="form-control" name="monthly_price" value="0"
                                                placeholder="Monthly Price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Yearly Price for all specialities</label>
                                            <input type="number" class="form-control" name="yearly_price" value="0"
                                                placeholder="Yearly Price">
                                        </div>
                                    </div>
                                    <div class="for_specific_specialities col-md-12">
                                        <div class="row specialist">
                                            <div class="col-md-4">
                                                <label class="form-label">Specialisation</label>
                                                <select class="form-control specialization"
                                                    name="specialist[specialist_id][]" id="specialist_id">
                                                    <option disabled="disabled" selected value="">Select specialist
                                                    </option>
                                                    @foreach ($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}">
                                                            {{ $specialization->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Monthly Price</label>
                                                    <input type="number" class="form-control"
                                                        name="specialist[monthly_price][]" placeholder="Monthly Price">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Yearly Price</label>
                                                    <input type="number" class="form-control"
                                                        name="specialist[yearly_price][]" placeholder="Yearly Price">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-primary add-button">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">No limit for quiz</label>
                                            <input type="checkbox" class="form-check-input" id="no_limit_for_quiz"
                                                value="1" name="no_limit_for_quiz" placeholder="No limit for quiz">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">No.Quiz available</label>
                                            <input type="number" class="form-control" name="num_available_quiz"
                                                id="num_available_quiz" placeholder="No.Quiz available">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">No limit for question</label>
                                            <input type="checkbox" class="form-check-input" id="no_limit_for_question"
                                                value="1" name="no_limit_for_question" placeholder="No limit for quiz">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">No.Question available Quiz</label>
                                            <input type="number" class="form-control" name="num_available_question"
                                                id="num_available_question" placeholder="No.Question available Quiz">
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
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" cols="2" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
                                <a href="{{ route('package.index') }}" class="btn btn-defult">Back</a>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
@push('js')
    <script src="{{ Module::asset('package:js/app.js') }}" defer></script>
@endpush
