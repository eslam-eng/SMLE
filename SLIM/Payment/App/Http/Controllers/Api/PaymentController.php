<?php

namespace SLIM\Payment\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Payment\App\resources\PaymentResource;
use SLIM\Payment\Interfaces\PaymentServiceInterfaces;
use SLIM\Traits\GeneralTrait;

class PaymentController extends Controller
{
    use GeneralTrait;

    protected PaymentServiceInterfaces $paymentServiceInterfaces;
    public function  __construct(PaymentServiceInterfaces $paymentServiceInterfaces)
    {
        $this->paymentServiceInterfaces=$paymentServiceInterfaces;

    }

    public function index()
    {
        $payments =PaymentResource::collection($this->paymentServiceInterfaces->getAll(['is_active' => 1]));
        return $this->returnDate($payments,'Payment List');
    }
}
