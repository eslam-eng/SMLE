<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class MyfatoorahService
{
    public string $myfatoorah_base_url;
    public string $myfatoorah_payment_url;
    public string $myfatoorah_api_key;
    public string $myfatoorah_call_back_url;

    public function __construct()
    {
        $this->myfatoorah_base_url = config('services.myfatoorah.url');
        $this->myfatoorah_payment_url = $this->myfatoorah_base_url . '/v2/SendPayment';
        $this->myfatoorah_api_key = config('services.myfatoorah.api_key');
        $this->myfatoorah_call_back_url = config('services.myfatoorah.call_back_url') . '/myfatoorah/callback';
    }


    public function handleInvoiceLink($customer,$package, array $requestData = [])
    {
        $invoiceData = [
            "CustomerName" => $customer->full_name,
            "NotificationOption" => "LNK",
            "CustomerMobile" => $customer->phone,
            "CustomerEmail" => $customer->email,
            "InvoiceValue" => Arr::get($requestData,'amount'),
            "MobileCountryCode"=> "966",
            "DisplayCurrencyIso" => "SAR",
            "CustomerReference" => $package->id,
            "UserDefinedField" =>json_encode($requestData),
            "CallBackUrl" => $this->myfatoorah_call_back_url,
            "Language" => "en",
            "InvoiceItems" => [
                [
                    "ItemName" => $package->name,
                    "Quantity" => 1,
                    "UnitPrice" =>Arr::get($requestData,'amount'),
                    "quizzes_number" => $package->num_available_quiz,
                    "questions_number" => $package->num_available_question,
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->myfatoorah_api_key,
        ])->post($this->myfatoorah_payment_url, $invoiceData);
        return $response->json();
    }

    public function checkMyfatoorhPayment($payment_id, $key_type = 'PaymentId')
    {
        $url = $this->myfatoorah_base_url . '/v2/getPaymentStatus';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->myfatoorah_api_key,
        ])->post($url, [
            "Key" => $payment_id,
            "KeyType" => $key_type
        ]);

        return $response->json();
    }

    private function handleErrorMessages()
    {
        return [
            'MF001' => '3DS authentication failed, possible reasons (user inserted a wrong password, cardholder/card issuer are not enrolled with 3DS, or the issuer bank has technical issue).',
            'MF002' => 'The issuer bank has declined the transaction, possible reasons (invalid card details, insufficient funds, denied by risk, the card is expired/held, or card is not enabled for online purchase).',
            'MF003' => 'The transaction has been blocked from the gateway, possible reasons (unsupported card BIN, fraud detection, or security blocking rules).',
            'MF004' => 'Insufficient funds',
            'MF005' => 'Session timeout',
            'MF006' => 'Transaction canceled',
            'MF007' => 'The card is expired.',
            'MF008' => 'The card issuer doesn\'t respond.',
            'MF009' => 'Denied by Risk',
            'MF010' => 'Wrong Security Code',
            'MF020' => 'Unspecified Failure',
        ];
    }
}
