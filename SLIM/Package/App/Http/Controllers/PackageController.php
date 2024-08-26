<?php

namespace SLIM\Package\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SLIM\Constants\App;
use SLIM\Package\App\Http\Requests\PackageRequest;
use SLIM\Package\App\Http\Requests\UpdatePackageRequest;
use SLIM\Package\App\Models\Package;
use SLIM\Package\Service\PackageService;
use SLIM\Specialization\Service\SpecializationService;
use SLIM\Trainee\App\Models\TraineeSubscribe;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private PackageService $packageService;
    private SpecializationService $specializationService;

    public function __construct(PackageService $packageService, SpecializationService $specializationService)
    {
        $this->packageService        = $packageService;
        $this->specializationService = $specializationService;
    }

    public function index(Request $request)
    {

        $packages = $this->packageService->withCount(['trainees'])
            ->getAllPaginated($request->all(), App::PAGINATE_LENGTH);

        if ($request->ajax())
        {
            return view('package::partial', compact('packages'));
        }

        return view('package::index', compact('packages'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->specializationService->getAll();
        return view('package::create', compact('specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $packageRequest)
    {
        DB::beginTransaction();
        try {

            if ($packageRequest->no_limit_for_quiz)
            {
                $packageRequest->merge(['num_available_quiz' => 0]);
            }

            if ($packageRequest->no_limit_for_question)
            {
                $packageRequest->merge(['num_available_question' => 0]);
            }

            //check if there is any free package
            if ($packageRequest->monthly_price < 1 && $packageRequest->yearly_price < 1){
                if (Package::query()->where('monthly_price', $packageRequest->monthly_price)
                    ->where('yearly_price',$packageRequest->yearly_price)->exists())
                    return response()->json([
                        'errors'=>[
                            'cannot make more than free package'
                        ]
                    ],422);
            }

            $package = $this->packageService->create($packageRequest->all());

            if ($packageRequest->specialist)
            {
                $this->packageService->setSpecializations($package, $packageRequest->specialist);
            }

            DB::commit();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            throw $exception;
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('abbreviation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $specializations = $this->specializationService->getAll();
        $package->load('specialists');
        return view('package::edit', compact('package', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $packageRequest, Package $package)
    {
        DB::beginTransaction();

        try {

            if ($packageRequest->no_limit_for_quiz)
            {
                $packageRequest->merge(['num_available_quiz' => 0]);
            }

            if ($packageRequest->no_limit_for_question)
            {
                $packageRequest->merge(['num_available_question' => 0]);
            }

            $this->packageService->update($package, $packageRequest->all());

            if ($packageRequest->specialist)
            {
                $this->packageService->setSpecializations($package, $packageRequest->specialist);
            }

            DB::commit();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            throw $exception;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package, Request $request)
    {

        if (TraineeSubscribe::where('package_id', $package->id)->where('is_active', 1)->count() > 0)
        {
            return response()->json([
                'status' => false,
                'errors' => [
                    'package' => 'Package can not be deleted because it has active subscribes'
                ]
            ], 200);
        }

        $this->packageService->delete($package);
        return $this->index($request);

    }

}
