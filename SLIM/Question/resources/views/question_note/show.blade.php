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
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Show Question note</h3>
                                <div class="row row-cards">
                                    <h3>Question Data</h3>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <textarea type="text" class="form-control" name="question" disabled placeholder="Question Title">{{ $question->question }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Model Answer</label>
                                            <input type="text" class="form-control" name="model_answer" disabled
                                                placeholder="Model Answer" value="{{ $question->model_answer }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Question Mark</label>
                                            <input type="number" class="form-control" name="question_mark" disabled
                                                placeholder="Question Mark" value="{{ $question->question_mark }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (A)</label>
                                            <input type="text" class="form-control" name="answer_a" disabled
                                                placeholder="Answer (A)" value="{{ $question->answer_a }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (B)</label>
                                            <input type="text" class="form-control" name="answer_b" disabled
                                                placeholder="Answer (B)" value="{{ $question->answer_b }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (C)</label>
                                            <input type="text" class="form-control" name="answer_c" disabled
                                                placeholder="Answer (C)" value="{{ $question->answer_c }}">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (D)</label>
                                            <input type="text" class="form-control" name="answer_d" disabled
                                                placeholder="Answer (D)" value="{{ $question->answer_d }}">

                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row row-cards">
                                    <h3>Trainee Notes On Question</h3>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">specialist</label>
                                            <input type="text" class="form-control" name="answer_d" disabled
                                                placeholder="Answer (D)" value="{{ $question->specialist?->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">sub specialist</label>
                                            <input type="text" class="form-control" name="answer_d" disabled
                                                placeholder="Answer (D)" value="{{ $question->sub_specialist?->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">status</label>
                                            <select class="form-control" name="is_active" disabled>
                                                <option disabled="disabled" selected>select status</option>
                                                <option value="1" {{ $question->is_active ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ !$question->is_active ? 'selected' : '' }}>In
                                                    Active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Question Description</label>
                                            <textarea class="form-control" name="description" disabled>{{ $question->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Question Note</label>
                                            <textarea class="form-control" name="description" disabled>{{ $question_note->note }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Question Image</label>
                                        </div>
                                        <img src="{{ asset($question->image) }}">
                                    </div>
                                    <hr />
                                    <h3>Trainee Data</h3>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Trainee Email</label>
                                            <input class="form-control" name="description"
                                                value="{{ $question_note->trainee?->email }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Trainee</label>
                                            <input class="form-control" name="description"
                                                value="{{ $question_note->trainee?->full_name }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Trainee Phone</label>
                                            <input class="form-control" name="description"
                                                value="{{ $question_note->trainee?->phone }}" disabled />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-center">
                                <a href="{{ route('question_note.index') }}" class="btn btn-defult">Back</a>
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
