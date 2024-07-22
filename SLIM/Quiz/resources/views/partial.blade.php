<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{ $quizs->total() }})</span>

<table class="table table-vcenter table-mobile-md card-table">
    <thead>
        <tr>

            <th>#</th>
            <th>Quiz ID</th>
            <th>Title</th>
            <th>Quiz date</th>
            <th>Trainee name</th>
            <th>Number of questions</th>
            <th>Correct answers percentage</th>
            <th>Quiz Status</th>
            <th>Quiz Level</th>
            <th class="w-1">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($quizs as $index => $quiz)
            <tr>
                <td class="text-secondary">
                    {{ ++$index }}
                </td>
                <td class="text-secondary">
                    {{ $quiz->id }}
                </td>


                <td class="text-secondary" data-label="Role">
                    {{ $quiz->title }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $quiz->quiz_date }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $quiz->trainee?->full_name }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $quiz->question_no }}
                </td>

                <td class="text-secondary" data-label="Role">
                    {{ floor(($quiz->CorrectAnswers->count() / $quiz->question_no) * 100) }}%
                </td>

                <td class="text-secondary" data-label="Role">
                    {{ $quiz->is_complete ? 'complete' :'not complete' }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $quiz->level }}
                </td>

                <td>
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('quiz.show', $quiz->id) }}" class="dropdown-item">
                                    Show
                                </a>
                                <a class="dropdown-item delete" href="{{ route('quiz.destroy', $quiz->id) }}">
                                    Delete
                                </a>

                                @if ($quiz->trainee_id)
                                    <a class="dropdown-item" href="{{ route('trainee.show', $quiz->trainee_id) }}">
                                        Trainee profile
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

{!! $quizs->render() !!}
