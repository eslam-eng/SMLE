<?php

namespace SLIM\Payment\App\Http\Controllers;

use App\Enum\SubscribeStatusEnum;
use App\Http\Controllers\Controller;
use App\Services\MyfatoorahService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SLIM\Package\App\Models\Package;
use SLIM\Payment\App\Http\Requests\PaymentRequest;
use SLIM\Payment\App\Models\Payment;
use SLIM\Payment\Interfaces\PaymentServiceInterfaces;
use SLIM\Trainee\App\Models\TraineeSubscribe;
use SLIM\Trainee\App\Models\TraineeSubscribeSpecialize;

class PaymentController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    protected PaymentServiceInterfaces $paymentServiceInterfaces;

    public function __construct(PaymentServiceInterfaces $paymentServiceInterfaces)
    {
        $this->paymentServiceInterfaces = $paymentServiceInterfaces;

    }

    public function index(Request $request)
    {
        $payments = $this->paymentServiceInterfaces->getAllPaginated($request->all(), 15);
        if ($request->ajax())
            return view('payment::partial', compact('payments'));
        return view('payment::index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $paymentRequest)
    {
        $this->paymentServiceInterfaces->create($paymentRequest->all());
        return $this->index($paymentRequest);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $paymentRequest, Payment $payment)
    {
        $this->paymentServiceInterfaces->update($payment, $paymentRequest->all());
        return $this->index($paymentRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment, Request $request)
    {
        $this->paymentServiceInterfaces->delete($payment);
        return $this->index($request);

    }
}
