<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{ $questions->total() }})</span>

<table class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Classification</th>
        <th>Trainee name</th>
        <th>quiz number</th>
        <th>Question Id</th>
        <th>Question</th>
        <th>Answers</th>
        <th>Model Answer</th>
    </tr>
    </thead>
    <tbody>
    @if($questions->isNotEmpty())
        @foreach ($questions as $index => $questionClassification)
            <tr>
                <td class="text-secondary">
                    {{ ++$index }}
                </td>
                <td class="text-secondary">
                    {{$questionClassification->category->name}}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $questionClassification->trainee?->full_name }}
                </td>
                <td class="text-secondary" data-label="Role">
                    <a href="{{route('quiz.show',$questionClassification->quiz_id)}}">{{ $questionClassification->quiz_id }}</a>
                </td>
                <td class="text-secondary" data-label="Role">
                    {{$questionClassification->question_id}}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ Str::limit($questionClassification->question?->question, 50) }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $questionClassification?->question?->answer_a }}<br/>
                    {{ $questionClassification?->question?->answer_b }}<br/>
                    {{ $questionClassification?->question?->answer_c }}<br/>
                    {{ $questionClassification?->question?->answer_d }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $questionClassification->question?->model_answer }}
                </td>

                <td>
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                @if ($questionClassification->trainee_id)
                                    <a class="dropdown-item"
                                       href="{{ route('trainee.show', $questionClassification->trainee_id) }}">
                                        Trainee profile
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach

    @else
        <tr>
            <td colspan="7" class="text-center">No data available</td>
        </tr>
    @endif
    </tbody>

</table>

{!! $questions->render() !!}
