<?php

namespace SLIM\Trainee\App\Http\Controllers\Api;

use App\Enum\SubscribeStatusEnum;
use App\Http\Controllers\Controller;
use App\Mail\PasswordRestMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use SLIM\Constants\HttpStatus;
use SLIM\Package\App\Models\Package;
use SLIM\Trainee\App\Http\Requests\LoginRequest;
use SLIM\Trainee\App\Http\Requests\RegisterRequest;
use SLIM\Trainee\App\Http\resources\TraineeResource;
use SLIM\Trainee\App\Models\Trainee;
use SLIM\Trainee\App\Models\TraineeSubscribe;
use SLIM\Trainee\App\Models\TraineeSubscribeSpecialize;
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
        $user->loadMissing(['activeSubscribe.package.specialist' => fn($query) => $query->whereIn('specializations.id', $active_subscribe_specialization_ids)]);
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
        //to do send otp to mail or phone
        $trainee = Trainee::where('email', $request->provider)->first();
        if (!$trainee)
            return $this->returnError('email not found', 404);

        $otp = rand(1000, 9999);
        DB::table('otp')->updateOrInsert(['provider' => $trainee->email], ['otp' => $otp]);
        Mail::to($trainee->email)->send(new PasswordRestMail(otp: $otp, receiver: $trainee));
        return $this->returnSuccessMessage('Code send successfully check your mail');
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
        $user = auth('api')->user()->load(['activeSubscribe']);
        $active_subscribe_specialization_ids = $user->activeSubscribe->tranineeSubscribeSpecialization()->pluck('specialist_id')->toArray();
        $user->loadMissing(['activeSubscribe.package.specialist' => fn($query) => $query->whereIn('specializations.id', $active_subscribe_specialization_ids)]);
        return new TraineeResource($user);

    }

    public function change_password(Request $request)
    {
        return $this->authService->changePassword($request->all());
    }

    public function subscribeToFreePackage($trainee, $package)
    {
        $traineeSubscribeSpecializeData = [];
        $traineeSubscribe = TraineeSubscribe::create([
                'package_id' => $package->id,
                'trainee_id' => $trainee->id,
                'package_type' => 'y',
                'start_date' => now()->format('Y-m-d'),
                'is_paid' => 1,
                'amount' => 0,
                'is_active' => true,
                'for_all_specialities' => true,
                'quizzes_count' =>$package->no_limit_for_quiz ? null :  $package->num_available_quiz,
                'remaining_quizzes' => $package->no_limit_for_quiz ? null :  $package->num_available_quiz,
                'num_available_question' => $package->num_available_question,
                'subscribe_status' => SubscribeStatusEnum::INPROGRESS->value
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
