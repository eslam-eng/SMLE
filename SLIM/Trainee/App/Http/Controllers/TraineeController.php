<?php

namespace SLIM\Trainee\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SLIM\Category\Service\CategoryService;
use SLIM\Package\App\Models\Package;
use SLIM\Question\App\Exports\AbbreviationExport;
use SLIM\Quiz\App\Models\Quiz;
use SLIM\Specialization\Service\SpecializationService;
use SLIM\Subspecialties\Interfaces\SubSpecializationServiceInterface;
use SLIM\Trainee\App\Exports\TraineeExport;
use SLIM\Trainee\App\Http\Requests\TraineeRequest;
use SLIM\Trainee\App\Http\Requests\TraineeUpdateRequest;
use SLIM\Trainee\App\Models\Trainee;
use SLIM\Trainee\services\TraineeService;
use SLIM\Traits\GeneralTrait;

class TraineeController extends Controller
{

    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    private TraineeService $traineeService;
    private SpecializationService $specializationService;
    private CategoryService $categoryService;
    protected $service;

    public function __construct(TraineeService                    $traineeService,
                                SpecializationService             $specializationService,
                                CategoryService                   $categoryService,
                                SubSpecializationServiceInterface $subSpecializationService
    )
    {
        $this->traineeService = $traineeService;
        $this->specializationService = $specializationService;
        $this->categoryService = $categoryService;
        $this->subSpecializationService = $subSpecializationService;
    }

    public function index(Request $request)
    {
        $specializations = $this->specializationService->getAll();
        $sub_specializations = $this->subSpecializationService->getAll();

        $trainees = $this->traineeService->withCount(['quizzes'])
            ->with(['activeSubscribe.package'])
            ->getAllPaginated($request->all(), 15);
        if ($request->ajax()) {
            return view('trainee::partial', compact('trainees'));
        }

        return view('trainee::index', compact('trainees', 'specializations', 'sub_specializations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->specializationService->getAll();
        return view('trainee::create', compact('specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TraineeRequest $traineeRequest)
    {
        $package = Package::where([
            'is_active' => 1,
            'price' => 0,
            'yearly_price' => 0,
            'monthly_price' => 0,
        ])->first();
        if (!$package) {
            return response(['errors' => [['There isn\'t Active Trial Package Available Now']]], 422);
        }

        $trainee = $this->traineeService->create($traineeRequest->all());
        $this->subscribe($trainee);
    }

    /**
     * Show the specified resource.
     */
    public function show(Trainee $trainee)
    {
        $trainee->load(['activeSubscribe.package'])->loadCount('quizzes');
        $active_subscribe_specialization_ids = $trainee->activeSubscribe->tranineeSubscribeSpecialization()->pluck('specialist_id')->toArray();
        $trainee->loadMissing(['activeSubscribe.package.specialist' => fn($query) => $query->whereIn('specializations.id', $active_subscribe_specialization_ids)]);
        $quizzes = Quiz::where('trainee_id', $trainee->id)->paginate(10);
        return view('trainee::show', compact('trainee','quizzes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainee $trainee)
    {
        $specializations = $this->specializationService->getAll();
        $subSpecializations = $this->subSpecializationService->getAll();

        return view('trainee::edit', compact('specializations', 'subSpecializations', 'trainee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TraineeUpdateRequest $traineeUpdateRequest, Trainee $trainee)
    {

        if ($traineeUpdateRequest->has('password')) {
            $traineeUpdateRequest->merge(['password' => $trainee->password]);
        } else {
            $traineeUpdateRequest->merge(['password' => $trainee->password]);
        }

        $this->traineeService->update($trainee, $traineeUpdateRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainee $trainee, Request $request)
    {
        $this->traineeService->delete($trainee);
        return $this->index($request);

    }


    public function subscribe($trainee)
    {
        $package = Package::where('price', 0)->first();

        $data['end_date'] = $this->getPackagePeriod(date('Y-m-d'), 'y');
        $data['amount'] = 0;
        $data['package_id'] = $package->id;
        $data['start_date'] = date('Y-m-d');
        $data['package_type'] = 'y';
        $trainee->packages()->sync([1 => $data]);

    }

    public function getPackagePeriod($startDate, $Type)
    {
        $endDate = '';

        if ($Type == 'm') {
            $endDate = \Carbon\Carbon::parse($startDate)->addMonths(1)->format('Y-m-d');
        } elseif ($Type == 'y') {
            $endDate = \Carbon\Carbon::parse($startDate)->addMonths(12)->format('Y-m-d');

        }

        return $endDate;
    }

    public function export()
    {
        $file_name = 'trainee' . now()->format('YmdHis') . '.xlsx';
        $trainees = $this->traineeService->getAll();
        return (new TraineeExport($trainees))->download($file_name);
    }

}
