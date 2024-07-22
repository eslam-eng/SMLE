<?php

namespace SLIM\Trainee\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use SLIM\Trainee\App\Http\Requests\SubscribeTraineeRequest;
use SLIM\Traits\GeneralTrait;

class SubscribeController extends Controller
{
    use GeneralTrait;

    public function subscribe(SubscribeTraineeRequest $subscribeTraineeRequest)
    {
        $request['end_date'] = $this->getPackagePeriod($subscribeTraineeRequest->start_date, $subscribeTraineeRequest->package_type);
        auth()->guard('api')->user()->packages()->sync([1 => $subscribeTraineeRequest->all()]);
        return $this->returnSuccessMessage('Subscribe Successfully');
    }

    public function getPackagePeriod($startDate, $Type)
    {
        $endDate = '';

        if ($Type == 'm')
        {
            $endDate = \Carbon\Carbon::parse($startDate)->addMonths(1)->format('Y-m-d');
        }
        elseif ($Type == 'y')
        {
            $endDate = \Carbon\Carbon::parse($startDate)->addMonths(12)->format('Y-m-d');

        }

        return $endDate;
    }

}
