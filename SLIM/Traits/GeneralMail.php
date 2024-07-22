<?php


namespace SLIM\Traits;


use Illuminate\Support\Facades\Mail;
use SLIM\Constants\HttpStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

Trait GeneralMail
{
    public function sendMailOtp($otp, $email)
    {
        Mail::send(['html' => 'mail'], ['otp' => $otp], function ($message) use ($email) {
            $message->to($email, 'SMLE APP')->subject('Verification');
            $message->from('info@smle.app', 'SMLE APP');
        });

    }



}
