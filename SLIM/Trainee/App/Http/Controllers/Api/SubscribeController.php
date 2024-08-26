<?php

namespace SLIM\Trainee\App\Http\Controllers\Api;

use App\Enum\SubscribeStatusEnum;
use App\Http\Controllers\Controller;
use App\Services\MyfatoorahService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SLIM\Package\App\Models\Package;
use SLIM\Payment\App\Models\Payment;
use SLIM\Trainee\App\Http\Requests\SubscribeTraineeRequest;
use SLIM\Trainee\App\Models\TraineeSubscribe;
use SLIM\Trainee\App\Models\TraineeSubscribeSpecialize;
use SLIM\Traits\GeneralTrait;

class SubscribeController extends Controller
{
    use GeneralTrait;

    public function subscribe(SubscribeTraineeRequest $request)
    {
        try {

            $subscriber = auth()->user();
            $payment = Payment::query()->find($request->payment_id);
            //get package with specialists
            $package = Package::query()
                ->with('specialist')
                ->where('id', $request->package_id)
                ->first();

            if (!$package)
                $this->returnError('package not found', 404);


            if (count($request->specialist_ids) < $package->specialists->count()) {
                $amount = $this->getTraineeSubscribeAmount($package, $request);
            } else {
                $amount = $request->package_type == 'm' ? $package->monthly_price : $package->yearly_price;
            }
            $requestData = $request->all();
            $requestData['amount'] = $amount;
            $requestData['trainee_id'] = $subscriber->id;

            if (strtoupper($payment->name) == 'BANK ACCOUNT') {
                $invoicePaymentData = (new MyfatoorahService())->handleInvoiceLink($subscriber, $package, $requestData);
                return $this->returnData([
                    'amount' => $amount,
                    'payment_link' => Arr::get($invoicePaymentData, 'Data.InvoiceURL')
                ], 'Subscribe Successfully will approve after confirm payment');
            }elseif (strtoupper($payment->name) == 'EXTERNAL') {
                if(!isset($request->invoice_file))
                    return $this->returnError('Please upload payment file',422);
                $start_date = date('Y-m-d');
                $end_date = $this->getPackagePeriod($request->package_type);

                DB::beginTransaction();
                $path = '';
                if ($request->hasFile('invoice_file')) {
                    $image = $request->file('invoice_file');
                    $path = $image->store('invoices', 'public');
                }
                $traineeSubscribe = TraineeSubscribe::query()->updateOrCreate([
                    'package_id' => $package->id,
                    'trainee_id' => $subscriber->id,
                    'is_active' => 0,
                    'is_paid' => 0,
                ], [

                        'invoice_file' => $path,
                        'package_type' => $request->package_type,
                        'payment_method' => $payment->name,
                        'subscribe_status' => SubscribeStatusEnum::IN_REVIEW->value,
                        'amount' => $amount,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'quizzes_count' => $package->no_limit_for_quiz ? null : $package->num_available_quiz,
                        'remaining_quizzes' => $package->no_limit_for_quiz ? null : $package->num_available_quiz,
                        'num_available_question' => $package->no_limit_for_question ? null : $package->num_available_question,
                    ]
                );
                $this->createTraineeSubscribeSpecialization($traineeSubscribe, $package, $request->specialist_ids);
                DB::commit();
                return $this->returnSuccessMessage('The receipt will be reviewed and payment will confirmed.');
            }


        } catch (\Exception $exception) {
            return $this->returnError($exception->getMessage(), 500);
        }

    }

    public function getPackagePeriod($type)
    {
        return $type == 'm' ? Carbon::now()->addMonth()->format('Y-m-d') : Carbon::now()->addYear()->format('Y-m-d');
    }


    private function createTraineeSubscribeSpecialization($traineeSubscribe, $package, $selected_specialist_ids = [])
    {
        $traineeSubscribeSpecializeData = [];
        $package->specialists->whereIn('specialist_id', $selected_specialist_ids)->each(function ($specialist) use ($traineeSubscribe, &$traineeSubscribeSpecializeData, $package) {
            $traineeSubscribeSpecializeData [] = [
                'trainee_subscribe_id' => $traineeSubscribe->id,
                'package_id' => $package->id,
                'specialist_id' => $specialist->specialist_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        });

        TraineeSubscribeSpecialize::query()->insert($traineeSubscribeSpecializeData);
    }

    private function getTraineeSubscribeAmount($package, $request)
    {
        $sum_column = $request->package_type == 'm' ? 'monthly_price' : 'yearly_price';
        return $package->specialists->whereIn('specialist_id', $request->specialist_ids)->sum($sum_column);
    }

}
