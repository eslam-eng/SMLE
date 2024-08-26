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
                        <div class="card-body">
                            <h3 class="card-title">Trainee Profile</h3>
                            <div class="row row-cards">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <p class="form-control">{{ $trainee->full_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">User name</label>
                                        <p class="form-control">{{ $trainee->user_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">E-mail</label>
                                        <p class="form-control">{{ $trainee->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <p class="form-control">{{ $trainee->phone }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cards">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Educational Degree</label>
                                        <p class="form-control">{{ $trainee->degree }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">status</label>
                                        <p class="form-control">
                                            {{$trainee->is_active ? 'Active' : 'Inactive'}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="container">
                                <h2>Trainee Subscription Package</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                @isset($trainee->activeSubscribe)
                                                    <h5 class="card-title">{{ $trainee->activeSubscribe?->package?->name}}</h5>
                                                    <p class="card-text">Paid:
                                                        {{ $trainee->activeSubscribe?->is_paid ? 'Yes' : 'No' }}
                                                    </p>
                                                    <p class="card-text">Trainee quizzes count:
                                                        {{ $trainee->activeSubscribe->quizzes_count ?? 'No Limit'}}
                                                    </p>
                                                    <p class="card-text">Trainee Remaining Quizzes:
                                                        {{ $trainee->activeSubscribe->remaining_quizzes ?? '-'}}
                                                    </p>
                                                    <p class="card-text">
                                                        Amount: {{ $trainee->activeSubscribe->amount }}</p>
                                                    <p class="card-text">Period:
                                                        {{  $trainee->activeSubscribe->package_type === 'm' ? 'Monthly' : 'Yearly' }}
                                                    </p>
                                                    <p class="card-text">Start Date:
                                                        {{  $trainee->activeSubscribe->start_date }}</p>
                                                    <p class="card-text">End
                                                        Date: {{  $trainee->activeSubscribe->end_date ?? '-' }}
                                                    </p>
                                                    <p class="card-text">Payment method:
                                                        {{  $trainee->activeSubscribe->payment_method }}
                                                    </p>
                                                    <p class="card-text">Active:
                                                        {{  $trainee->activeSubscribe->is_active ? 'Yes' : 'No' }}</p>
                                                    @if ( $trainee->activeSubscribe->invoice_file)
                                                        <a href="{{$trainee->activeSubscribe->invoice_file }}"
                                                           class="btn btn-primary">View Invoice</a>
                                                    @endif
                                                @else
                                                    <p class="alert alert-info">there is no subscribe</p>
                                                @endisset


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="text-dark">Trainee Subscribe Specialization</h3>
                                                <ul>
                                                    @foreach($trainee->activeSubscribe->tranineeSubscribeSpecialization as $traineeSpecialization)
                                                        <li>{{$traineeSpecialization->specialist->name}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <h2>Quizes</h2>
                                <span class="btn btn-dark" style="margin:10px 10px 10px 10px">Quizes count({{ $trainee->quizzes_count }})</span>

                                <table class="table table-vcenter table-mobile-md card-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Quiz date</th>
                                        <th>Trainee name</th>
                                        <th>Number of questions</th>
                                        <th>Correct answers percentage</th>
                                        <th class="w-1">Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($trainee->quizzes_count)
                                        @foreach ($quizzes as $index => $quiz)
                                            <tr>
                                                <td class="text-secondary">
                                                    {{ ++$index }}
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
                                                    {{ ($quiz->correctAnswers->count() / $quiz->question_no) * 100 }}%
                                                </td>

                                                <td>
                                                    <div class="btn-list flex-nowrap">
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle align-text-top"
                                                                    data-bs-toggle="dropdown">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a href="{{ route('quiz.show', $quiz->id) }}"
                                                                   class="dropdown-item">
                                                                    Show
                                                                </a>
                                                                <a class="dropdown-item delete"
                                                                   href="{{ route('quiz.destroy', $quiz->id) }}">
                                                                    Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="text-center text-danger">
                                            <td colspan="7">no quizzes found</td>
                                        </tr>
                                    @endif
                                    </tbody>

                                </table>
                                {!! $quizzes->render() !!}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
<style>
    .package-container {
        margin: 0 auto;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .package-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
    }

    .package-item {
        margin-bottom: 1rem;
    }

    .package-item p {
        margin-bottom: 0.5rem;
        font-weight: bold;
    }

    .package-item ul {
        list-style: none;
        padding: 0;
    }

    .package-item li {
        margin-bottom: 0.25rem;
    }

    .package-item a {
        color: #007bff;
        text-decoration: none;
    }

    .package-item a:hover {
        text-decoration: underline;
    }
</style>
@push('js')
    <script src="{{ Module::asset('trainee:js/app.js') }}" defer></script>
@endpush
