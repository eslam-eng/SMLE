<?php

namespace SLIM\Trainee\App\Http\Controllers\Api;

use App\Enum\SubscribeStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SLIM\Constants\HttpStatus;
use SLIM\Package\App\Models\Package;
use SLIM\Trainee\App\Http\Requests\LoginRequest;
use SLIM\Trainee\App\Http\Requests\RegisterRequest;
use SLIM\Trainee\App\Models\Trainee;
use SLIM\Trainee\App\Models\TraineeSubscribe;
use SLIM\Trainee\App\Models\TraineeSubscribeSpecialize;
use SLIM\Trainee\App\resources\TraineeResource;
use SLIM\Trainee\services\AuthService;
use SLIM\Traits\GeneralMail;
use SLIM\Traits\GeneralTrait;

class AuthController extends Controller
{
    use GeneralTrait, GeneralMail;

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $loginRequest)
    {

        $credentials = $loginRequest->only('user', 'password');
        $token = $this->authService->login($credentials);
        if (!$token)
            return $this->returnError('Incorrect User or password', HttpStatus::AUTHENTICATION_FAILURE);

        $data = $this->authService->createToken($token);
        $user = auth('api')->user()->load(['activeSubscribe']);
        $active_subscribe_specialization_ids = $user->activeSubscribe->tranineeSubscribeSpecialization()->pluck('specialist_id')->toArray();
        $user->load(['activeSubscribe.package.specialist'=>fn($query)=>$query->whereIn('specializations.id', $active_subscribe_specialization_ids)]);
        $data['trainee'] = new TraineeResource($user);
        return $data;

    }

    public function Register(RegisterRequest $registerRequest)
    {
        try {
            $package = Package::with('specialists')->where('monthly_price', 0)
                ->where('yearly_price', 0)
                ->first();

            if (!$package) {
                return $this->returnError('there isn\'t Active Trail Package Available Now', 422);
            }
            DB::beginTransaction();
            $registerRequest['password'] = Hash::make($registerRequest->password);
            $registerRequest['is_active'] = 1;
            $trainee = $this->authService->register($registerRequest->all());
            $this->subscribeToFreePackage($trainee, $package);
            DB::commit();
            return $this->returnSuccessMessage('Trainee Created Successfully');
        } catch (\Exception $exception) {
            return $this->returnError($exception->getMessage(), 500);
        }

    }

    public function sendOtp(Request $request)
    {
        $generator = 123456789;
        $trainee = Trainee::where('email', $request->provider)
            ->orwhere('phone', $request->provider)->first();
        if ($trainee) {
            $otp = rand(1000, 9999);
            if (filter_var($request->provider, FILTER_VALIDATE_EMAIL)) {
                // $this->sendMailOtp($otp,$request->provider);
                $this->authService->saveOtp($otp, $request->provider);
                return $this->returnSuccessMessage('Otp send Successfully check Your Mail');
            } else {

            }
        }

        return $this->returnError('Invalid Provider', HttpStatus::PRECONDITION_FAILED);
    }

    public function ValidateOtp(Request $request)
    {
        $otp = $this->authService->ValidateOtp($request->only('otp', 'provider'));
        if ($otp)
            return $this->returnSuccessMessage('otp is Correct');
        else
            return $this->returnError('Invalid Otp', HttpStatus::PRECONDITION_FAILED);
    }

    public function reset_password(Request $request)
    {
        $trainee = $this->authService->getTrainee($request->only('provider'));
        if (is_null($trainee))
            return $this->returnError('Provider in Correct', HttpStatus::PRECONDITION_FAILED);
        else
            $this->authService->resetPassword($request->only('provider', 'new_password'));
        return $this->returnSuccessMessage('Password Reset Successfully');
    }

    public function profile()
    {
        $trainee = new TraineeResource(auth('api')->user());
        return $this->returnData($trainee, 'Trainee Data');
    }

    public function change_password(Request $request)
    {
        return $this->authService->changePassword($request->all());
    }

    public function subscribeToFreePackage($trainee, $package)
    {
        $traineeSubscribeSpecializeData = [];
        $start_date = date('Y-m-d');
        $end_date = Carbon::parse($start_date)->addMonth()->format('Y-m-d');
        $traineeSubscribe = TraineeSubscribe::create([
                'package_id' => $package->id,
                'trainee_id' => $trainee->id,
                'package_type' => 'm',
                'is_paid' => 1,
                'amount' => 0,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'is_active' => true,
                'for_all_specialities' => true,
                'subscribe_status'=>SubscribeStatusEnum::INPROGRESS->value
            ]
        );
        $package->specialists->each(function ($specialist) use ($traineeSubscribe, &$traineeSubscribeSpecializeData, $package) {
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
}
