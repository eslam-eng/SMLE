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
                        <form class="card" id="updateForm" action="{{ route('package.update', $package->id) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                <h3 class="card-title">Update Package</h3>
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Package Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Package Name" value="{{ $package->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Monthly Price for all specialities</label>
                                            <input type="number" class="form-control" name="monthly_price"
                                                value="{{ $package->monthly_price }}" placeholder="Monthly Price">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Yearly Price for all specialities</label>
                                            <input type="number" class="form-control" name="yearly_price"
                                                value="{{ $package->yearly_price }}" value="0"
                                                placeholder="Yearly Price">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="col-md-4">
                                        <button class="btn btn-primary add-button">Add</button>
                                    </div>
                                    @if ($package->specialist()->count() > 0)
                                        <div class="for_specific_specialities col-md-12">
                                            @foreach ($package->specialists as $specialist)
                                                <div class="row specialist">
                                                    <div class="col-md-4">
                                                        <label class="form-label">specialisation</label>
                                                        <select class="form-control specialization"
                                                            name="specialist[specialist_id][]" id="specialist_id">
                                                            <option disabled="disabled" selected value=""> select
                                                                specialist
                                                            </option>
                                                            @foreach ($specializations as $specialization)
                                                                <option value="{{ $specialization->id }}"
                                                                    {{ $specialization->id == $specialist?->specialist_id ? 'selected' : '' }}>
                                                                    {{ $specialization->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Monthly Price</label>
                                                            <input type="number" class="form-control"
                                                                name="specialist[monthly_price][]"
                                                                placeholder="Monthly Price" required
                                                                value="{{ $specialist?->monthly_price }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Yearly Price</label>
                                                            <input type="number" class="form-control"
                                                                name="specialist[yearly_price][]" placeholder="Yearly Price"
                                                                required value="{{ $specialist?->yearly_price }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3"><button class="btn btn-danger mt-5 remove-button"><i class="fa fa-trash"></i></button></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="for_specific_specialities col-md-12">
                                            <div class="row specialist">
                                                <div class="col-md-4">
                                                    <label class="form-label">specialisation</label>
                                                    <select class="form-control specialization"
                                                        name="specialist[specialist_id][]" id="specialist_id">
                                                        <option disabled="disabled" selected value=""> select
                                                            specialist
                                                        </option>
                                                        @foreach ($specializations as $specialization)
                                                            <option value="{{ $specialization->id }}">
                                                                {{ $specialization->name }}
                                                            </option>
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
                                    @endif
                                </div>
                                <hr />
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">No limit for quiz</label>
                                            <input type="checkbox" class="form-check-input" id="no_limit_for_quiz"
                                                {{ $package->no_limit_for_quiz == 1 ? 'checked' : '' }} value="1"
                                                name="no_limit_for_quiz" placeholder="No limit for quiz">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">No.Quiz available</label>
                                            <input type="number" class="form-control" name="num_available_quiz"
                                                value="{{ $package->num_available_quiz }}" id="num_available_quiz"
                                                placeholder="No.Quiz available">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">No limit for question</label>
                                            <input type="checkbox" class="form-check-input" id="no_limit_for_question"
                                                {{ $package->no_limit_for_question == 1 ? 'checked' : '' }} value="1"
                                                name="no_limit_for_question" placeholder="No limit for quiz">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">No.Question available Quiz</label>
                                            <input type="number" class="form-control" name="num_available_question"
                                                value="{{ $package->num_available_question }}"
                                                id="num_available_question" placeholder="No.Question available Quiz">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Is Active</label>
                                            <select class="form-select" name="is_active" id="is_active">
                                                <option disabled="disabled" selected> select status</option>

                                                <option value="1" {{ $package->is_active ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ !$package->is_active ? 'selected' : '' }}>
                                                    InActive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" cols="2" rows="5">{{ $package->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
                                <a href="{{ route('package.index') }}" class="btn btn-default">Back</a>
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
