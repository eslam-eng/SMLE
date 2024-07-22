<?php

namespace SLIM\Trainee\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SLIM\Constants\App;
use SLIM\Package\App\Models\Package;
use SLIM\Package\interfaces\PackageServiceInterface;
use SLIM\Payment\Interfaces\PaymentServiceInterfaces;
use SLIM\Trainee\App\Http\Requests\SubscribeRequest;
use SLIM\Trainee\interfaces\TraineeServiceInterface;

class TraineeSubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected TraineeServiceInterface $traineeServiceInterface;
    protected PackageServiceInterface $packageServiceInterface;
    protected PaymentServiceInterfaces $paymentServiceInterface;

    public function __construct(TraineeServiceInterface $traineeServiceInterface, PackageServiceInterface $packageServiceInterface,
        PaymentServiceInterfaces $paymentServiceInterface)
    {
        $this->traineeServiceInterface = $traineeServiceInterface;
        $this->packageServiceInterface = $packageServiceInterface;
        $this->paymentServiceInterface = $paymentServiceInterface;
    }

    public function index(Request $request)
    {
        $request['packages'] = 1;
        $subscribes          = $this->traineeServiceInterface->with(['packages'])->getAllPaginated($request->all(), App::PAGINATE_LENGTH);
        $packages            = $this->packageServiceInterface->getAll(['is_active' => 1]);
        $trainees            = $this->traineeServiceInterface->getAll(['is_active' => 1]);
        $payments            = $this->paymentServiceInterface->getAll(['is_active' => 1]);

        if ($request->ajax())
        {
            return view('trainee::subscribe.partial', compact('subscribes'));
        }

        return view('trainee::subscribe.index', compact('subscribes', 'trainees', 'packages', 'payments'));
    }

    public function create()
    {
        $packages = $this->packageServiceInterface->getAll(['is_active' => 1]);
        $trainees = $this->traineeServiceInterface->getAll(['is_active' => 1]);
        $payments = $this->paymentServiceInterface->getAll(['is_active' => 1]);

        return view('trainee::subscribe.create', compact('packages', 'trainees', 'payments'));
    }

    public function edit($id)
    {
        $packages  = $this->packageServiceInterface->getAll(['is_active' => 1]);
        $trainees  = $this->traineeServiceInterface->getAll(['is_active' => 1]);
        $payments  = $this->paymentServiceInterface->getAll(['is_active' => 1]);
        $subscribe = $this->traineeServiceInterface->with(['packages'])->findorfail($id);

        return view('trainee::subscribe.edit', compact('packages', 'trainees', 'payments', 'subscribe'));
    }

    public function getCost(Request $request)
    {
        $package = Package::where('id', $request->package_id)->first();

        if ($request->package_type == 'm')
        {
            return $package->monthly_price;
        }
        elseif ($request->package_type == 'y')
        {
            return $package->yearly_price;
        }
        else
        {
            return $package->price;
        }

    }

    public function store(SubscribeRequest $subscribeRequest)
    {

        if ($subscribeRequest->hasFile('invoice'))
        {
            $fileName = $subscribeRequest->invoice->HashName();
            $subscribeRequest->invoice->storeAs('public/invoice', $fileName);
            $subscribeRequest->merge([
                'invoice_file' => 'storage/invoice/' . $fileName
            ]);
        }

        $trainee = $this->traineeServiceInterface->findOrFail($subscribeRequest->trainee_id);
        $trainee->packages()->sync([1 => $subscribeRequest->except('_token', 'invoice')]);
    }

    public function update(SubscribeRequest $subscribeRequest)
    {
        $trainee = $this->traineeServiceInterface->findOrFail($subscribeRequest->trainee_id);

        if ($subscribeRequest->hasFile('invoice'))
        {
            $fileName = $subscribeRequest->invoice->HashName();
            $subscribeRequest->invoice->storeAs('public/invoice', $fileName);
            $subscribeRequest->merge([
                'invoice_file' => 'storage/invoice/' . $fileName
            ]);
        }
        else
        {
            $subscribeRequest->merge([
                'invoice_file' => $trainee['packages'][0]['pivot']['invoice_file']
            ]);

        }

        $trainee->packages()->sync([1 => $subscribeRequest->except('_token', 'invoice')]);
    }

    public function getEndDate(Request $request)
    {
        $endDate = '';

        if ($request->package_type == 'm')
        {
            $endDate = \Carbon\Carbon::parse($request->start_date)->addMonths(1)->format('Y-m-d');
        }
        elseif ($request->package_type == 'y')
        {
            $endDate = \Carbon\Carbon::parse($request->start_date)->addMonths(12)->format('Y-m-d');

        }

        return $endDate;
    }

    public function delete(Request $request, $id)
    {
        $trainee = $this->traineeServiceInterface->findorfail($id);
        $trainee->packages()->detach();
        return $this->index($request);
    }

}
