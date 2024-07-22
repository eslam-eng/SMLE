<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{ $question_note->total() }})</span>

<table class="table table-vcenter table-mobile-md card-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Trainee name</th>
            <th>Question Id</th>
            <th>Question</th>
            <th>Answers</th>
            <th>Model Answer</th>
            <th>Note</th>
            <th class="w-1">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($question_note as $index => $note)
            <tr>
                <td class="text-secondary">
                    {{ ++$index }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $note->trainee?->full_name }}
                </td>
                <td class="text-secondary" data-label="Role">
                    <a href="{{ route('question.edit', $note->question_id) }}">{{ $note->question_id }} </a>
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ Str::limit($note->question?->question, 100) }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $note?->question?->answer_a }}<br />
                    {{ $note?->question?->answer_b }}<br />
                    {{ $note?->question?->answer_c }}<br />
                    {{ $note?->question?->answer_d }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $note->question?->model_answer }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ Str::limit($note->note, 100) }}
                </td>
                <td>
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('question_note.show', $note->id) }}" class="dropdown-item">
                                    Show
                                </a>
                                <a class="dropdown-item delete" href="{{ route('question_note.destroy', $note->id) }}">
                                    Delete
                                </a>
                                @if ($note->trainee_id)
                                    <a class="dropdown-item" href="{{ route('trainee.show', $note->trainee_id) }}">
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

{!! $question_note->render() !!}
