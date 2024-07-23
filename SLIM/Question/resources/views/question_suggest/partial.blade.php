<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{ $question_suggest->total() }})</span>

<table class="table table-vcenter table-mobile-md card-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Trainee name</th>
            <th>Quiz number</th>
            <th>Question Id</th>
            <th>Question</th>
            <th>Answers</th>
            <th>Model Answer</th>
            <th>Trainee Answer</th>
            <th>Suggest</th>
            <th class="w-1">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($question_suggest as $index => $suggest)
            <tr>
                <td class="text-secondary">
                    {{ ++$index }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $suggest->trainee?->full_name }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $suggest->quiz_id }}
                </td>
                <td class="text-secondary" data-label="Role">
                    <a href="{{ route('question.edit', $suggest->question_id) }}">{{ $suggest->question_id }} </a>
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ Str::limit($suggest->question?->question, 60) }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $suggest?->question?->answer_a }}<br />
                    {{ $suggest?->question?->answer_b }}<br />
                    {{ $suggest?->question?->answer_c }}<br />
                    {{ $suggest?->question?->answer_d }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $suggest->question?->model_answer }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $suggest->answer }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ Str::limit($suggest->suggest, 60) }}
                </td>
                <td>
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item delete"
                                    href="{{ route('question_suggest.destroy', $suggest->id) }}">
                                    Delete
                                </a>
                                @if ($suggest->trainee_id)
                                    <a class="dropdown-item" href="{{ route('trainee.show', $suggest->trainee_id) }}">
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

{!! $question_suggest->render() !!}
