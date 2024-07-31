@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
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
                                            <p class="form-control text-dark">{{ $quiz->id }}</p>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz title</label>
                                            <p class="form-control text-dark">{{ $quiz->title }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz Status</label>
                                            <p class="form-control text-dark">{{  $quiz->is_complete ==1 ? 'complete' : 'Not Complete' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <h3>Trainee</h3>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <p class="form-control text-dark">{{  $quiz->trainee?->full_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">User name</label>
                                            <p class="form-control text-dark">{{  $quiz->trainee?->user_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <p class="form-control text-dark">{{  $quiz->trainee?->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <p class="form-control text-dark">{{  $quiz->trainee?->phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <hr/>

                                <div class="row row-cards">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz date</label>
                                            <p class="form-control text-dark">{{  $quiz->quiz_date }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz time</label>
                                            <p class="form-control text-dark">{{  $quiz->quiz_time }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz Level</label>
                                            <p class="form-control text-dark">{{  $quiz->level_text }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Correct Answer Percentage</label>
                                            <p class="form-control text-dark">{{$quiz->question_no ?  $quiz->correct_answers /$quiz->question_no : 0  }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Number of questions</label>
                                            <p class="form-control text-dark">{{$quiz->question_no}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Number of Correct answers</label>
                                            <p class="form-control text-dark">{{$quiz->correct_answers}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Number of InCorrect answers</label>
                                            <p class="form-control text-dark">{{$quiz->incorrect_answers}}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Quiz Timer</label>
                                            <p class="form-control text-dark">{{$quiz->quiz_time}}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Question stop watch</label>
                                            <p class="form-control text-dark">{{ $quiz->question_stop_watch ? 'Enabled' : 'Disabled' }}</p>
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
                                    <hr/>
                                </div>

                                <div class="row row-cards">
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
                                                       placeholder="Quiz date" disabled
                                                       value="{{ $subSpecialist->name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr/>
                                <div class="row row-cards mb-2">
                                    <h4>Answered Questions</h4>
                                    <table class="table table-vcenter table-bordered table-mobile-md card-table">
                                        <thead>
                                        <tr>
                                            <td>question</td>
                                            <td>specialist</td>
                                            <td>choice1</td>
                                            <td>choice2</td>
                                            <td>choice3</td>
                                            <td>choice4</td>
                                            <td>model answer</td>
                                            <td>trainee answer</td>
                                            <td>correct</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($quiz->answerdQuestions as $question)
                                            <tr>
                                                <td>{{$question->question}}</td>
                                                <td>{{$question->specialist->name | $question->sub_specialist->name}}</td>
                                                <td>{{$question->answer_a}}</td>
                                                <td>{{$question->answer_b}}</td>
                                                <td>{{$question->answer_c}}</td>
                                                <td>{{$question->answer_d}}</td>
                                                <td>{{$question->model_answer}}</td>
                                                <td>{{$question->pivot?->user_answer}}</td>
                                                <td>{{$question->pivot->is_correct ? 'yes':'no'}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-dark text-center" colspan="8">No Answered Questions</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row row-cards">
                                    <h4>Un Answered Questions</h4>
                                    <table class="table table-vcenter table-bordered table-mobile-md card-table">
                                        <thead>
                                        <tr>
                                            <td>question</td>
                                            <td>specialist</td>
                                            <td>choice1</td>
                                            <td>choice2</td>
                                            <td>choice3</td>
                                            <td>choice4</td>
                                            <td>model answer</td>
                                            <td>trainee answer</td>
                                            <td>correct</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quiz->unanswerdQuestions as $question)
                                            <tr>
                                                <td>{{$question->question}}</td>
                                                <td>{{$question->specialist?->name ."||". $question->sub_specialist?->name}}</td>
                                                <td>{{$question->answer_a}}</td>
                                                <td>{{$question->answer_b}}</td>
                                                <td>{{$question->answer_c}}</td>
                                                <td>{{$question->answer_d}}</td>
                                                <td>{{$question->model_answer}}</td>
                                                <td>{{$question->pivot?->user_answer}}</td>
                                                <td>{{$question->pivot->is_correct ? 'yes':'no'}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
