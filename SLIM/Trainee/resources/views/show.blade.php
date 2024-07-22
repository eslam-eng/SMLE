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
                        <form class="card" id="updateForm" action="{{ route('trainee.update', $trainee->id) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                <h3 class="card-title">Trainee Profile</h3>
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" disabled
                                                placeholder="Full Name" value="{{ $trainee->full_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">User name</label>
                                            <input type="text" class="form-control" name="user_name" disabled
                                                placeholder="User Name" value="{{ $trainee->user_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" class="form-control" name="email" placeholder="E-mail"
                                                disabled value="{{ $trainee->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="phone" class="form-control" name="phone" placeholder="Phone"
                                                disabled value="{{ $trainee->phone }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Educational Degree</label>
                                            <input type="text" class="form-control" name="degree" placeholder="Degree"
                                                disabled value="{{ $trainee->degree }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">status</label>
                                            <select class="form-control" name="is_active" disabled>
                                                <option disabled="disabled" selected>select status</option>
                                                <option value="1" {{ $trainee->is_active ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ !$trainee->is_active ? 'selected' : '' }}>In
                                                    Active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">specialist</label>
                                            <input type="text" name="specialist_id" class="form-control" disabled
                                                value="{{ $trainee->specialist?->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">sub specialist</label>
                                            <input type="text" name="sub_specialist_id" class="form-control" disabled
                                                value="{{ $trainee->sub_specialist?->name }}">
                                        </div>
                                    </div>
                                </div>
                                <hr />

                                <div class="container">
                                    <h2>Packages</h2>
                                    <hr width="50%" />
                                    <div class="row">
                                        @foreach ($trainee->packages as $index => $package)
                                            <div class="col-md-6">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $package->name }}</h5>
                                                        <p class="card-text">Paid:
                                                            {{ $package?->pivot?->is_paid ? 'Yes' : 'No' }}
                                                        </p>
                                                        <p class="card-text">Package quizes count:
                                                            {{ $package->no_limit_for_quiz ? 'No limit' : $package->num_available_quiz }}
                                                        </p>
                                                        <p class="card-text">Trainee quezes available:
                                                            {{ $package->no_limit_for_quiz ? '-' : $package->num_available_quiz - $trainee->quizzes->count() }}
                                                        </p>
                                                        <p class="card-text">Amount: {{ $package?->pivot?->amount }}</p>
                                                        <p class="card-text">Period:
                                                            {{ $package?->pivot?->package_type === 'm' ? 'Monthly' : 'Yearly' }}
                                                        </p>
                                                        <p class="card-text">Start Date:
                                                            {{ $package?->pivot?->start_date }}</p>
                                                        <p class="card-text">End Date: {{ $package?->pivot?->end_date }}
                                                        </p>
                                                        <p class="card-text">Payment method:
                                                            {{ $package?->pivot?->payment_method }}
                                                        </p>
                                                        <p class="card-text">Active:
                                                            {{ $package?->pivot?->is_active ? 'Yes' : 'No' }}</p>
                                                        @if ($package?->pivot?->invoice_file)
                                                            <a href="{{ $package?->pivot?->invoice_file }}"
                                                                class="btn btn-primary">View Invoice</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="container">
                                    <hr width="50%" />
                                    <h2>Quizes</h2>
                                    <span class="btn btn-dark" style="margin:10px 10px 10px 10px">Quizes count
                                        ({{ $quizes->total() }})</span>

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
                                            @foreach ($quizes as $index => $quiz)
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
                                                        {{ ($quiz->CorrectAnswers->count() / $quiz->question_no) * 100 }}%
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

                                                                    @if ($quiz->trainee_id)
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('trainee.show', $quiz->trainee_id) }}">
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

                                    {!! $quizes->render() !!}
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                            </div>
                        </form>
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
