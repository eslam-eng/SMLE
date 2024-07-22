<?php


namespace SLIM\Trainee\services;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use SLIM\Constants\App;
use SLIM\Constants\HttpStatus;
use SLIM\Trainee\App\Models\Trainee;
use SLIM\Traits\GeneralTrait;

class AuthService
{

    use GeneralTrait;
    public function createToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth(App::API_GUARD)->factory()->getTTL() * App::EXPIRATION_TIME,
        ];
    }

    public function login($credentials)
    {
        $credentials=$this->credentials($credentials);
        return auth(App::API_GUARD)->attempt($credentials);
    }

    public function register($userData)
    {

        return Trainee::create($userData);

    }

    public function credentials($credentials)
    {

        if (is_numeric($credentials['user'] )) {
            return ['phone' => $credentials['user'], 'password' => $credentials['password'] ];
        } elseif (filter_var($credentials['user'], FILTER_VALIDATE_EMAIL)) {
            return ['email' => $credentials['user'], 'password' => $credentials['password']];
        }
        return ['user_name' => $credentials['user'], 'password' => $credentials['password']];
    }

    public function ValidateOtp($data)
    {
        return $this->getOtpOne(array('otp'=>$data['otp'],'provider'=>$data['provider']));
    }

    public function getTrainee($data)
    {
        return Trainee::where(function ($query)use($data){
            $query->where('phone',$data['provider'])->orwhere('email',$data['provider']);
        })->first();
    }
     public function resetPassword($data)
    {
       return $this->getTrainee($data)->update(['password'=>Hash::make($data['new_password'])]);
    }
    public function changePassword($data)
    {

//        if(auth('api')->user()->password != Hash::make($data['old_password']))
//              return $this->returnError('Old Password Wrong ',HttpStatus::PRECONDITION_FAILED);

        auth('api')->user()->update([
            'password' => Hash::make($data['new_password'])
        ]);

        return $this->returnSuccessMessage('Password Change Successfully');

    }
    public function saveOtp($otpCode, $provider)
    {
        $otp = $this->getOtp(array('otp'=>$otpCode,'provider'=>$provider));
        if($otp)
        {
         return $this->updateOtp(array('otp'=>$otpCode,'provider'=>$provider));
        }
       return $this->insertOtp(array('otp'=>$otpCode,'provider'=>$provider));
    }

    public function getOtp($data=[])
    {
        return \DB::table('otp')->where(['provider' => $data['provider'] ])->first();
    }

    public function getOtpOne($data=[])
    {
        return \DB::table('otp')->where(['otp' => $data['otp'],'provider' => $data['provider'] ])->first();
    }

    public function insertOtp($data)
    {
         \DB::table('otp')->insert([
            'otp'=>$data['otp'],
            'provider'=>$data['provider'],
        ]);

    }

    public function updateOtp($data)
    {
        \DB::table('otp')
            ->where('provider', $data['provider'])
            ->update(['otp' => $data['otp']]);
    }

}

