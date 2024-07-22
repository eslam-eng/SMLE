<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{ $trainees->total() }})</span>

<table class="table table-vcenter table-mobile-md card-table">
    <thead>
        <tr>

            <th>#</th>
            <th>Full Name</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>UserName</th>
{{--            <th>Specialist</th>--}}
{{--            <th>Sub Specialist</th>--}}
            <th>Educational degree</th>
            <th>Package</th>
            <th>No. Quizzes</th>
            <th>Is Active</th>
            <th class="w-1">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trainees as $index => $trainee)
            <tr>
                <td class="text-secondary">
                    {{ ++$index }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $trainee->full_name }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $trainee->email }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $trainee->phone }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $trainee->user_name }}
                </td>

{{--                <td class="text-secondary" data-label="Role">--}}
{{--                    {{ $trainee['specialist'] ? $trainee['specialist']['name'] : '-' }}--}}
{{--                </td>--}}


{{--                <td class="text-secondary" data-label="Role">--}}
{{--                    {{ $trainee['sub_specialist'] ? $trainee['sub_specialist']['name'] : '-' }}--}}
{{--                </td>--}}
                <td class="text-secondary" data-label="Role">
                    {{ $trainee->degree }}
                </td>

                <td class="text-secondary" data-label="Role">
                    {{ $trainee->packages()->count() > 0 ?$trainee->packages()->first()->name ??'' :\SLIM\Package\App\Models\Package::where('price',0)->first()->name  }}
                </td>

                <td class="text-secondary" data-label="Role">
                    {{ $trainee->quizzes()->count() ?? 0 }}
                </td>
                <td class="text-secondary" data-label="Role">
                            {{ $trainee->is_active ? 'Yes' : 'No' }}
                </td>





                <td>
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('trainee.edit', $trainee->id) }}" class="dropdown-item">
                                    edit
                                </a>
                                <a class="dropdown-item delete" href="{{ route('trainee.destroy', $trainee->id) }}">
                                    Delete
                                </a>

                                <a class="dropdown-item" href="{{ route('trainee.show', $trainee->id) }}">
                                    Trainee profile
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

{!! $trainees->render() !!}
