<?php

namespace SLIM\Trainee\App\Http\Controllers\Api;

use SLIM\Constants\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use SLIM\Package\App\Models\Package;
use SLIM\Trainee\App\Http\Requests\SubscribeTraineeRequest;
use SLIM\Trainee\App\Models\Trainee;
use SLIM\Trainee\App\resources\TraineeResource;
use SLIM\Trainee\services\AuthService;
use SLIM\Traits\GeneralMail;
use SLIM\Traits\GeneralTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Trainee\App\Http\Requests\LoginRequest;
use SLIM\Trainee\App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    use GeneralTrait, GeneralMail;

      protected AuthService $authService;
      public function __construct(AuthService $authService)
      {
          $this->authService=$authService;
      }

    public function login(LoginRequest $loginRequest)
    {

        $credentials = $loginRequest->only('user', 'password');
        $token = $this->authService->login($credentials);
        if (!$token)
            return $this->returnError('Incorrect User or password', HttpStatus::AUTHENTICATION_FAILURE);

        $data = $this->authService->createToken($token);
        $data['trainee'] = new TraineeResource(auth('api')->user());
        return $this->returnDate('items', $data, 'Trainee Login Successfully');

    }

    public function Register(RegisterRequest $registerRequest)
    {
        $package = Package::where([
            'is_active'=>1,
            'price'=>0,
            'yearly_price'=>0,
            'monthly_price'=>0,
        ])->first();
          if(!$package)
          {
            return  $this->returnError('there isn\'t Active Trail Package Available Now',422);
          }
        $registerRequest['password'] = Hash::make($registerRequest->password);
        $registerRequest['is_active'] =1;
        $trainee = $this->authService->register($registerRequest->all());
        $this->subscribe($trainee);

       return $this->returnSuccessMessage('Trainee Created Successfully');
    }

   public function sendOtp(Request $request)
   {
         $generator=123456789;
         $trainee =  Trainee::where('email',$request->provider)
                        ->orwhere('phone',$request->provider)->first();
         if($trainee)
              {
                  $otp = rand(1000, 9999);
                  if (filter_var($request->provider, FILTER_VALIDATE_EMAIL))
                  {
                      // $this->sendMailOtp($otp,$request->provider);
                      $this->authService->saveOtp($otp,$request->provider);
                     return  $this->returnSuccessMessage('Otp send Successfully check Your Mail');
                  }
                  else
                  {

                  }
              }

           return $this->returnError('Invalid Provider',HttpStatus::PRECONDITION_FAILED);
   }
   public function ValidateOtp(Request $request)
   {
        $otp = $this->authService->ValidateOtp($request->only('otp','provider'));
        if($otp)
           return  $this->returnSuccessMessage('otp is Correct');
       else
           return $this->returnError('Invalid Otp',HttpStatus::PRECONDITION_FAILED);
   }

    public function reset_password(Request $request)
    {
        $trainee = $this->authService->getTrainee($request->only('provider'));
        if(is_null($trainee))
            return $this->returnError('Provider in Correct',HttpStatus::PRECONDITION_FAILED);
        else
            $this->authService->resetPassword($request->only('provider','new_password'));
            return  $this->returnSuccessMessage('Password Reset Successfully');
    }
    public function profile()
    {
        $trainee = new TraineeResource(auth('api')->user());
        return $this->returnDate( $trainee, 'Trainee Data');
    }
    public function change_password(Request $request)
    {
       return  $this->authService->changePassword($request->all());
    }
    public function subscribe($trainee)
    {
        $package = Package::where('price',0)->first();

        $data['end_date'] = $this->getPackagePeriod(date('Y-m-d'), 'y');
        $data['amount']=0;
        $data['package_id'] =$package->id;
        $data['start_date'] =date('Y-m-d');
        $data['package_type'] ='y';
        $trainee->packages()->sync([1 => $data]);

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
