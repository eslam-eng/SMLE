<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{ $questions->total() }})</span>

<table class="table table-vcenter table-mobile-md card-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Question</th>
            <th>specialization </th>
            <th>Sub specialization</th>
            <th>Model Answer</th>
            <th>Question mark</th>
            <th>Is Active</th>
            <th>No. Quizzes</th>
            <th class="w-1">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($questions as $index => $question)
            <tr>
                <td class="text-secondary">
                    {{ ++$index }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ substr($question->question,0,20) }}
                </td>


                <td class="text-secondary" data-label="Role">
                    {{ $question?->specialist->name }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $question?->sub_specialist->name }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $question->model_answer }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $question->question_mark }}
                </td>

                <td class="text-secondary" data-label="Role">
                    {{ $question->is_active ? 'Yes' : 'No' }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $question->quizzes_count}}
                </td>
                <td>
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('question.edit', $question->id) }}" class="dropdown-item">
                                    edit
                                </a>
                                <a class="dropdown-item delete" href="{{ route('question.destroy', $question->id) }}">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

{!! $questions->render() !!}
