<?php

namespace App\Http\Controllers;

use SLIM\Category\App\Models\Category;
use SLIM\Package\App\Models\Package;
use SLIM\Question\App\Models\Question;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Subspecialties\App\Models\SubSpecialties;
use SLIM\Trainee\App\Models\Trainee;
use SLIM\Trainee\App\Models\TraineeSubscribe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $traineeCount             = Trainee::count();
        $questionCount            = Question::count();
        $quizCount                = Quiz::count();
        $specializationCount      = Specialization::count();
        $subSpecializationCount   = SubSpecialties::count();
        $classificationCount      = Category::count();
        $packageCount             = Package::count();
        $subscriptionCount        = TraineeSubscribe::where('is_active', 1)->where('is_paid', 1)->count();
        $monthlySubscriptionCount = TraineeSubscribe::where('is_active', 1)->where('is_paid', 1)->where('package_type', 'm')->count();
        $yearlySubscriptionCount  = TraineeSubscribe::where('is_active', 1)->where('is_paid', 1)->where('package_type', 'y')->count();

        // trainee most has quiz
        $traineesMostHasQuiz = Trainee::query()
            ->withCount('quizzes')
            ->orderBy('quizzes_count', 'desc')
            ->take(5)->get();

        // trainee most has quiz with correct answers
        $specializatMostHasSubscription = Specialization::withCount(['subscribes' => function ($q)
        {
            $q->whereHas('traineeSubscribe', fn($query)=>$query->where('is_active',1)->where('is_paid', 1));
        }, 'questions'])
            ->orderBy('subscribes_count', 'desc')->take(5)->get();

        return view('admin::home', compact('traineeCount', 'questionCount', 'subscriptionCount',
            'monthlySubscriptionCount', 'yearlySubscriptionCount',
            'quizCount', 'specializationCount', 'subSpecializationCount', 'classificationCount',
            'packageCount', 'traineesMostHasQuiz', 'specializatMostHasSubscription'
        ));
    }
}
