<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MyfatoorahService
{
    public string $myfatoorah_url;
    public string $myfatoorah_api_key;
    public string $myfatoorah_call_back_url;

    public function __construct()
    {
        $this->myfatoorah_url = config('services.myfatoorah.url');
        $this->myfatoorah_api_key = config('services.myfatoorah.api_key');
        $this->myfatoorah_call_back_url = config('services.myfatoorah.call_back_url');
    }


    public function handleInvoiceLink($customer, $created_trainee_subscribe)
    {
        $invoiceData = [
            "CustomerName" => $customer->name,
            "NotificationOption" => "LNK",
            "MobileCountryCode" => "965",
            "CustomerMobile" => $customer->phone,
            "CustomerEmail" => $customer->email,
            "InvoiceValue" => $created_trainee_subscribe->amount,
            "DisplayCurrencyIso" => "SAU",
            "CallBackUrl" => $this->myfatoorah_call_back_url,
            "Language" => "en",
            "InvoiceItems" => [
                [
                    "ItemName" => $created_trainee_subscribe->package->name,
                    "Quantity" => 1,
                    "UnitPrice" => $created_trainee_subscribe->amount
                ]
            ]
        ];

        $response = Http::withToken($this->myfatoorah_api_key)->post($this->myfatoorah_url, $invoiceData);
        return $response->json();
    }
}
