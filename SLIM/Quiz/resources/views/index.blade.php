@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">

        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <h5>Trainees Quizzes Page</h5>

                    <div class="col-12">
                        <form class="card">
                            <div class="card-body">
                                <h3 class="card-title">Filter Quizzes</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz ID</label>
                                            <input type="text" class="form-control" placeholder="Quiz ID"
                                                   id="quiz_id">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz title</label>
                                            <input type="text" class="form-control" placeholder="Quiz title"
                                                id="quiz_title">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label"> Difficulty Level</label>
                                            <select class="form-control Difficulty" name="difficulty_level"
                                                id="difficulty_level">
                                                <option selected disabled> All</option>
                                                <option value="easy"> Easy</option>
                                                <option value="intermediate"> Intermediate</option>
                                                <option value="difficult"> Difficult</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Trainee Name</label>
                                            <input type="text" class="form-control" placeholder="Trainee Name"
                                                id="full_name">
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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">specialization</label>
                                            <select class="form-control specialization" name="specialist_id"
                                                id="specialist_id">
                                                <option disabled="disabled" selected> select specialist</option>
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
                                                <option disabled="disabled" selected> select Sub specialist</option>
                                                @foreach ($sub_specializations as $sub_specialization)
                                                    <option value="{{ $sub_specialization->id }}">
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
                                <button type="submit" class="btn btn-dark" id="searchBtn">Search</button>
                                <button type="reset" class="btn btn-default" id="Resetsearch">Reset</button>

                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            @include('quiz::partial')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
    <script src="{{ Module::asset('quiz:js/app.js') }}" defer></script>
@endpush
