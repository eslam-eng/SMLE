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
                        <div class="card" id="updateForm">
                            <div class="card-body">
                                <h3 class="card-title">Show Quiz</h3>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz #</label>
                                            <input type="text" class="form-control" name="quiz_id" placeholder="Quiz #"
                                                disabled value="{{ $quiz->id }}">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz title</label>
                                            <input type="text" class="form-control" name="quiz_title" disabled
                                                placeholder="Quiz title" value="{{ $quiz?->title }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz Status</label>
                                            <input type="text" class="form-control" name="quiz_title" disabled
                                                   placeholder="Quiz title" value="{{ $quiz->is_complete ==1 ? 'complete' : 'Not Complete' }}">
                                        </div>
                                    </div>


                                </div>
                                <div class="row row-cards">
                                    <hr />

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" disabled
                                                placeholder="Full Name" value="{{ $quiz->trainee?->full_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">User name</label>
                                            <input type="text" class="form-control" name="user_name" disabled
                                                placeholder="User Name" value="{{ $quiz->trainee?->user_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" class="form-control" name="email" placeholder="E-mail"
                                                disabled value="{{ $quiz->trainee?->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="phone" class="form-control" name="phone" placeholder="Phone"
                                                disabled value="{{ $quiz->trainee?->phone }}">
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row row-cards">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz date</label>
                                            <input type="text" class="form-control" name="quiz_date"
                                                placeholder="Quiz date" disabled value="{{ $quiz->quiz_date }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz time</label>
                                            <input type="text" class="form-control" name="level"
                                                placeholder="Quiz date" disabled value="{{ $quiz->quiz_time }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz Level</label>
                                            <input type="text" class="form-control" name="level"
                                                placeholder="Quiz date" disabled value="{{ $quiz->level }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Correct Answer Percentage</label>
                                            <input type="text" class="form-control" name="degree"
                                                placeholder="Quiz date" disabled
                                                value="{{ ($quiz->CorrectAnswers->count() / $quiz->question_no) * 100 }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-cards">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Number of questions</label>
                                            <input type="text" class="form-control" name="quiz_id"
                                                placeholder="Number of questions" disabled
                                                value="{{ $quiz->question_no }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Number of Correct answers</label>
                                            <input type="text" class="form-control" name="quiz_id"
                                                placeholder="Number of questions" disabled
                                                value="{{ $quiz->CorrectAnswers->count() }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Number of InCorrect answers</label>
                                            <input type="text" class="form-control" name="quiz_id"
                                                placeholder="Number of questions" disabled
                                                value="{{ $quiz->InCorrectAnswers->count() }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz Timer</label>
                                            <input type="text" class="form-control" name="quiz_time"
                                                placeholder="Quiz Timer" disabled
                                                value="{{ $quiz->quiz_time ? 'Enabled' : 'Disabled' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Time taken</label>
                                            <input type="text" class="form-control" name="time_taken"
                                                placeholder="Time taken" disabled value="{{ $quiz->time_taken }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question stop watch</label>
                                            <input type="text" class="form-control" name="quiz_stop_watch"
                                                placeholder="Question stop watch" disabled
                                                value="{{ $quiz->question_stop_watch ? 'Enabled' : 'Disabled' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question time</label>
                                            <input type="text" class="form-control" name="question_time"
                                                placeholder="Question time" disabled
                                                value="{{ $quiz->question_time . ' min' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Auto correction</label>
                                            <input type="text" class="form-control" name="auto_correction"
                                                placeholder="Question time" disabled
                                                value="{{ $quiz->auto_correction ? 'Enabled' : 'Disabled' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Number of attempts allowed</label>
                                            <input type="text" class="form-control" name="number_attempt_allowed"
                                                placeholder="Number of attempts allowed" disabled
                                                value="{{ $quiz->number_attempt_allowed }}">
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="col-md-12 row row-cards">
                                    <div class="col-md-6">
                                        <label class="form-label">Speciality</label>
                                        @foreach ($quiz->specialist as $specialist)
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="quiz_date"
                                                    placeholder="Speciality1" disabled
                                                    value="{{ $quiz->specialist?->first()?->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sub Speciality</label>
                                        @foreach ($quiz->Subspecialist as $subSpecialist)
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="level"
                                                    placeholder="Quiz date" disabled value="{{ $subSpecialist->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr />

                                <div class="row row-cards">
                                    <h4>Quiz Questions</h4>
                                    @foreach ($quiz->listQuestions as $question)
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Question head</label>
                                            <input type="text" class="form-control" name="question" disabled
                                                placeholder="Question" value="{{ $question->question }}">
                                        </div>
                                        <div class="mb-3 col-md-1">
                                            <label class="form-label">Choice 1</label>
                                            <input type="text" class="form-control" name="answer" disabled
                                                placeholder="{{ $question?->answer_a }}"
                                                value="{{ $question?->answer_a }}">
                                        </div>
                                        <div class="mb-3 col-md-1">
                                            <label class="form-label">Choice 2</label>
                                            <input type="text" class="form-control" name="answer" disabled
                                                placeholder="{{ $question?->answer_b }}"
                                                value="{{ $question?->answer_b }}">
                                        </div>
                                        <div class="mb-3 col-md-1">
                                            <label class="form-label">Choice 3</label>
                                            <input type="text" class="form-control" name="answer" disabled
                                                placeholder="{{ $question?->answer_c }}"
                                                value="{{ $question?->answer_c }}">
                                        </div>
                                        <div class="mb-3 col-md-1">
                                            <label class="form-label">Choice 1</label>
                                            <input type="text" class="form-control" name="answer" disabled
                                                placeholder="{{ $question?->answer_d }}"
                                                value="{{ $question?->answer_d }}">
                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Model answer</label>
                                            <input type="text" class="form-control" name="mode_answer" disabled
                                                value="{{ $question?->model_answer }}">
                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Trainee answer</label>
                                            <input type="text" class="form-control" name="mode_answer" disabled
                                                value="{{ $question?->pivot?->answer }}">
                                        </div>
                                        <div class="mb-3 col-md-1">
                                            <label class="form-label">Is correct</label>
                                            <input type="text" class="form-control" name="is_correct" disabled
                                                value="{{ $question?->pivot?->is_correct == 1 ? 'Yes' : 'No' }}">
                                        </div>
                                    @endforeach
                                </div>

                            </div>


                            <div class="card-footer text-center">
                                <a href="{{ route('quiz.index') }}" class="btn btn-default">Back</a>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
@push('js')
@endpush
