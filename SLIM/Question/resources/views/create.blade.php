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
                                <h3 class="card-title">Add New Question</h3>
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <textarea class="form-control" name="question" rows="5" cols="6"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Model Answer</label>
                                            <input type="text" class="form-control" name="model_answer"
                                                placeholder="Model Answer">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Question Mark</label>
                                            <input type="number" class="form-control" name="question_mark"
                                                placeholder="Question Mark" value="0">
                                        </div>
                                    </div>

                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (A)</label>
                                            <input type="text" class="form-control" name="answer_a"
                                                placeholder="Answer (A)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (B)</label>
                                            <input type="text" class="form-control" name="answer_b"
                                                placeholder="Answer (B)">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (C)</label>
                                            <input type="text" class="form-control" name="answer_c"
                                                placeholder="Answer (C)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (D)</label>
                                            <input type="text" class="form-control" name="answer_d"
                                                placeholder="Answer (D)">

                                        </div>

                                    </div>




                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">specialisation</label>
                                            <select class="form-control specialization" name="specialist_id">
                                                <option disabled="disabled" selected> select specialisation</option>
                                                @foreach ($specializations as $specialization)
                                                    <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Sub specialization</label>
                                            <select class="form-control sub-specialization" name="sub_specialist_id">
                                                <option disabled="disabled" selected> select Sub specialization</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">status</label>
                                            <select class="form-control" name="is_active">
                                                <option disabled="disabled" selected>select status</option>
                                                <option value="1">Active</option>
                                                <option value="0">In Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">status</label>
                                            <select class="form-control" name="abbreviations[]" multiple select2>
                                                <option disabled="disabled" selected>select status</option>
                                               @foreach($abbreviations as $abbreviation)
                                                <option value={{$abbreviation->id}}>{{$abbreviation->char_abbreviations}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Question Level</label>
                                            <select class="form-control" name="level">
                                                <option disabled="disabled" selected>Select status</option>
                                                <option value="1">Easy</option>
                                                <option value="2">Intermediate</option>
                                                <option value="3">Difficult</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-cards">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Question Description (optional)</label>
                                            <textarea class="form-control" name="description"></textarea>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Question Image (options)</label>
                                            <input type="file" name="question_image" class="form-control">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
                                <a href="{{ route('question.index') }}" class="btn btn-defult">Back</a>

                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
@push('js')
    <script src="{{ Module::asset('question:js/app.js') }}" defer></script>
@endpush
