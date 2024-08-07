<?php

namespace SLIM\Trainee\App\Http\Controllers;

use App\Enum\SubscribeStatusEnum;
use App\Http\Controllers\Controller;
use App\Services\MyfatoorahService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SLIM\Package\App\Models\Package;
use SLIM\Package\interfaces\PackageServiceInterface;
use SLIM\Payment\Interfaces\PaymentServiceInterfaces;
use SLIM\Trainee\App\Http\Requests\SubscribeRequest;
use SLIM\Trainee\App\Models\TraineeSubscribe;
use SLIM\Trainee\App\Models\TraineeSubscribeSpecialize;
use SLIM\Trainee\interfaces\TraineeServiceInterface;

class TraineeSubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected TraineeServiceInterface $traineeServiceInterface;
    protected PackageServiceInterface $packageServiceInterface;
    protected PaymentServiceInterfaces $paymentServiceInterface;

    public function __construct(TraineeServiceInterface  $traineeServiceInterface, PackageServiceInterface $packageServiceInterface,
                                PaymentServiceInterfaces $paymentServiceInterface)
    {
        $this->traineeServiceInterface = $traineeServiceInterface;
        $this->packageServiceInterface = $packageServiceInterface;
        $this->paymentServiceInterface = $paymentServiceInterface;
    }

    public function index(Request $request)
    {
        $filters = array_filter($request->all(), function ($value) {
            return $value !== null && $value !== false && $value !== '';
        });


        $subscribesQuery = TraineeSubscribe::query();
        $subscribesQuery = $this->applyFilters($subscribesQuery, $filters);

        $subscribes = $subscribesQuery->with([
            'package:id,name',
            'trainee:id,full_name,phone',
            'tranineeSubscribeSpecialization.specialist'
        ])
            ->paginate();

        $packages = $this->packageServiceInterface->getAll(['is_active' => 1]);
        $trainees = $this->traineeServiceInterface->getAll(['is_active' => 1]);
        $payments = $this->paymentServiceInterface->getAll(['is_active' => 1]);
        if ($request->ajax()) {
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
        $packages = $this->packageServiceInterface->getAll(['is_active' => 1]);
        $trainees = $this->traineeServiceInterface->getAll(['is_active' => 1]);
        $payments = $this->paymentServiceInterface->getAll(['is_active' => 1]);
        $subscribe = $this->traineeServiceInterface->with(['packages'])->findorfail($id);

        return view('trainee::subscribe.edit', compact('packages', 'trainees', 'payments', 'subscribe'));
    }

    public function getCost(Request $request)
    {
        $package = Package::where('id', $request->package_id)->first();

        if ($request->package_type == 'm') {
            return $package->monthly_price;
        } elseif ($request->package_type == 'y') {
            return $package->yearly_price;
        } else {
            return $package->price;
        }

    }

    public function store(SubscribeRequest $subscribeRequest)
    {

        if ($subscribeRequest->hasFile('invoice')) {
            $fileName = $subscribeRequest->invoice->HashName();
            $subscribeRequest->invoice->storeAs('public/invoice', $fileName);
            $subscribeRequest->merge([
                'invoice_file' => 'storage/invoice/' . $fileName
            ]);
        }
        DB::beginTransaction();

        TraineeSubscribe::query()
            ->where('trainee_id', $subscribeRequest->trainee_id)
            ->whereIn('subscribe_status', [SubscribeStatusEnum::INPROGRESS->value, SubscribeStatusEnum::PENDING->value])
            ->update(['subscribe_status' => SubscribeStatusEnum::FINISHED->value, 'is_active' => false]);

        $package = Package::query()->where('id', $subscribeRequest->package_id)->first();

        $traineeSubscribe = TraineeSubscribe::create([
                'package_id' => $subscribeRequest->package_id,
                'trainee_id' => $subscribeRequest->trainee_id,
                'package_type' => $subscribeRequest->package_type,
                'payment_method' => 'external',
                'subscribe_status' => SubscribeStatusEnum::INPROGRESS->value,
                'is_paid' => 1,
                'invoice_file' => $subscribeRequest->invoice_file,
                'amount' => $subscribeRequest->package_type == 'm' ? $package->monthly_price : $package->yearly_price,
                'start_date' => $subscribeRequest->start_date,
                'end_date' => $subscribeRequest->end_date,
                'is_active' => true,
                'quizzes_count' => $package->num_available_quiz,
                'remaining_quizzes' => $package->num_available_quiz,
                'num_available_question' => $package->num_available_question,
            ]
        );
        $traineeSubscribeSpecializeData = [];
        foreach ($package->specialists as $specialist) {
            $traineeSubscribeSpecializeData [] = [
                'trainee_subscribe_id' => $traineeSubscribe->id,
                'package_id' => $package->id,
                'specialist_id' => $specialist->specialist_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        TraineeSubscribeSpecialize::query()->insert($traineeSubscribeSpecializeData);
        DB::commit();
        return redirect(route('subscribe-trainee.index'))->with('success', 'Subscribed successfully');
    }

    public function update(SubscribeRequest $subscribeRequest)
    {
        $trainee = $this->traineeServiceInterface->findOrFail($subscribeRequest->trainee_id);

        if ($subscribeRequest->hasFile('invoice')) {
            $fileName = $subscribeRequest->invoice->HashName();
            $subscribeRequest->invoice->storeAs('public/invoice', $fileName);
            $subscribeRequest->merge([
                'invoice_file' => 'storage/invoice/' . $fileName
            ]);
        } else {
            $subscribeRequest->merge([
                'invoice_file' => $trainee['packages'][0]['pivot']['invoice_file']
            ]);

        }

        $trainee->packages()->sync([1 => $subscribeRequest->except('_token', 'invoice')]);
    }

    public function getEndDate(Request $request)
    {
        $endDate = '';

        if ($request->package_type == 'm') {
            $endDate = \Carbon\Carbon::parse($request->start_date)->addMonths(1)->format('Y-m-d');
        } elseif ($request->package_type == 'y') {
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

    private function applyFilters($query, $filters)
    {

        foreach ($filters as $key => $value) {
            if (isset($value)) {
                switch ($key) {
                    case 'trainee_id':
                        $query->where('trainee_id', $value);
                        break;
                    case 'package_id':
                        $query->where('package_id', $value);
                        break;
                    case 'active':
                        $query->where('is_active', $value);
                        break;
                    case 'is_paid':
                        $query->where('is_paid', $value);
                        break;
                    case 'payment':
                        $query->where('payment_method', $value);
                        break;
                    case 'package_type':
                        $query->where('package_type', $value);
                        break;
                    // Add more filter conditions based on your requirements
                    default:
                        break;
                }
            }
        }
        return $query;
    }


    public function getPackagePeriod($type)
    {
        return $type == 'm' ? Carbon::now()->addMonth()->format('Y-m-d') : Carbon::now()->addYear()->format('Y-m-d');
    }

    public function approve($trainee_subscribe_id)
    {
        $traineeSubscribe = $this->traineeServiceInterface->findOrFail($trainee_subscribe_id);

        TraineeSubscribe::query()
            ->where('trainee_id', $traineeSubscribe->trainee_id)
            ->whereIn('subscribe_status', [SubscribeStatusEnum::INPROGRESS->value, SubscribeStatusEnum::PENDING->value])
            ->update(['subscribe_status' => SubscribeStatusEnum::FINISHED->value, 'is_active' => false]);

        $traineeSubscribe->update([
            'is_active' => 1,
            'is_paid' => 1,
            'subscribe_status' => SubscribeStatusEnum::INPROGRESS,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => $this->getPackagePeriod($traineeSubscribe->package_type)
        ]);
        return back()->with('success', 'Subscribe Approved Successfully');
    }

    public function changeStatus($trainee_subscribe_id)
    {
        $traineeSubscribe = $this->traineeServiceInterface->findOrFail($trainee_subscribe_id);
        $traineeSubscribe->update(['is_active' => !$traineeSubscribe->is_active]);
        return back()->with('success', 'Subscribe status changed Successfully');
    }


    public function myfatoorahCallback(Request $request)
    {
        $paymentId = Arr::get($request->all(), 'paymentId');
        try {
            $response = (new MyfatoorahService())->checkMyfatoorhPayment($paymentId);
            if (isset($response) && $response['IsSuccess']) {
                $requestData = json_decode(Arr::get($response, 'Data.UserDefinedField'), true);
                $package = Package::query()
                    ->where('id', Arr::get($response, 'Data.CustomerReference'))
                    ->first();
                $start_date = date('Y-m-d');
                $end_date = $this->getPackagePeriod($requestData['package_type']);
                DB::beginTransaction();
                TraineeSubscribe::query()
                    ->where('trainee_id', $requestData['trainee_id'])
                    ->whereIn('subscribe_status', [SubscribeStatusEnum::INPROGRESS->value, SubscribeStatusEnum::PENDING->value])
                    ->update(['subscribe_status' => SubscribeStatusEnum::FINISHED->value, 'is_active' => false]);

                $traineeSubscribe = TraineeSubscribe::create([
                        'package_id' => $package->id,
                        'trainee_id' => $requestData['trainee_id'],
                        'package_type' => $requestData['package_type'],
                        'payment_method' => 'online',
                        'subscribe_status' => SubscribeStatusEnum::INPROGRESS->value,
                        'is_paid' => 1,
                        'amount' => $requestData['amount'],
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'is_active' => true,
                        'quizzes_count' => $package->num_available_quiz,
                        'remaining_quizzes' => $package->num_available_quiz,
                        'num_available_question' => $package->num_available_question,
                        'payment_transaction_id' => Arr::last(Arr::get($response, 'Data.InvoiceTransactions'))['TransactionId'],
                        'payment_invoice_number' => Arr::get($response, 'Data.InvoiceId'),
                    ]
                );
                $traineeSubscribeSpecializeData = [];
                foreach ($requestData['specialist_ids'] as $specialist_id) {
                    $traineeSubscribeSpecializeData [] = [
                        'trainee_subscribe_id' => $traineeSubscribe->id,
                        'package_id' => $package->id,
                        'specialist_id' => $specialist_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                TraineeSubscribeSpecialize::query()->insert($traineeSubscribeSpecializeData);
                DB::commit();
                return response()->json([
                    'data' => null,
                    'message' => 'payment successes , your subscribe is confirmed',
                    'status' => true
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'data' => $exception->getMessage(),
                'message' => 'payment successes , your subscribe is confirmed',
                'status' => true
            ]);
        }
    }
}
