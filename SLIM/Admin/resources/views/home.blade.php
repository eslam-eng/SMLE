@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">

                    <div class="col" style="margin-left:831px">

                    </div>
                </div>

            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        Statics
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Trainees</h3>
                            </div>
                            <div class="card-body">
                                {{ $traineeCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Questions</h3>
                            </div>
                            <div class="card-body">
                                {{ $questionCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Subscription</h3>
                            </div>
                            <div class="card-body">
                                {{ $subscriptionCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Monthly Subscription value</h3>
                            </div>
                            <div class="card-body">
                                {{ $monthlySubscriptionCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Yearly Subscription value</h3>
                            </div>
                            <div class="card-body">
                                {{ $yearlySubscriptionCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Quizzes</h3>
                            </div>
                            <div class="card-body">
                                {{ $quizCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Specialities</h3>
                            </div>
                            <div class="card-body">
                                {{ $specializationCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sub Specialities</h3>
                            </div>
                            <div class="card-body">
                                {{ $subSpecializationCount }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Classification</h3>
                            </div>
                            <div class="card-body">
                                {{ $classificationCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Packages</h3>
                            </div>
                            <div class="card-body">
                                {{ $packageCount }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Trainees with most quizzes</h3>
                            </div>
                            <div class="card-body">
                                <span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total
                                    ({{ $traineesMostHasQuiz->count() }})</span>

                                <table class="table table-vcenter table-mobile-md card-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Phone</th>
                                            <th>UserName</th>
{{--                                            <th>Specialist</th>--}}
{{--                                            <th>Sub Specialist</th>--}}
                                            <th>Educational degree</th>
                                            <th>Quiz</th>
                                            <th>Is Active</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($traineesMostHasQuiz as $index => $trainee)
                                            <tr>
                                                <td class="text-secondary">
                                                    {{ ++$index }}
                                                </td>
                                                <td class="text-secondary" data-label="Role">
                                                    {{ $trainee->full_name }}
                                                </td>

                                                <td class="text-secondary" data-label="Role">
                                                    {{ $trainee->phone }}
                                                </td>
                                                <td class="text-secondary" data-label="Role">
                                                    {{ $trainee->user_name }}
                                                </td>

                                                <td class="text-secondary" data-label="Role">
                                                    {{ $trainee['specialist'] ? $trainee['specialist']['name'] : '-' }}
                                                </td>


{{--                                                <td class="text-secondary" data-label="Role">--}}
{{--                                                    {{ $trainee['sub_specialist'] ? $trainee['sub_specialist']['name'] : '-' }}--}}
{{--                                                </td>--}}
                                                <td class="text-secondary" data-label="Role">
                                                    {{ $trainee->degree }}
                                                </td>
                                                <td class="text-secondary" data-label="Role">
                                                    {{ $trainee->quizzes_count }}
                                                </td>
                                                <td class="text-secondary" data-label="Role">
                                                    {{ $trainee->is_active ? 'Yes' : 'No' }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                <h3 class="card-title">Specialities most subscribed</h3>
                            </div>
                            <div class="card-body">
                                <span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total
                                    ({{ $specializatMostHasSubscription->count() }})</span>

                                <table class="table table-vcenter table-mobile-md card-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>N. question</th>
                                            <th>N. Subscribe</th>
                                            <th>Is Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($specializatMostHasSubscription as $index => $specialization)
                                            <tr>
                                                <td class="text-secondary">
                                                    {{ ++$index }}
                                                </td>
                                                <td class="text-secondary" data-label="Role">
                                                    {{ $specialization->name }}
                                                </td>
                                                <td class="text-secondary" data-label="Role">
                                                    {{ $specialization->questions_count }}
                                                </td>

                                                <td class="text-secondary" data-label="Role">
                                                    {{ $specialization->subscribes_count ?? 0 }}
                                                </td>

                                                <td class="text-secondary" data-label="Role">
                                                    {{ $specialization->is_active ? 'Yes' : 'No' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
