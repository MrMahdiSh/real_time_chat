<?php

namespace App\Helper;


use Modules\Payment\Entities\PaymentSetting;

use SoapClient as SoapClient;

class ZarinPal
{
    public $merchant_id = '';

//20fec483-4239-4367-bdd8-2490e6d902c4
    public function __construct()
    {
        $setting = PaymentSetting::first();
        $this->merchant_id = $setting->merchant_id;
    }

    public function SendRequest($price, $CallbackURL)
    {

        try {
            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        } catch (\SoapFault $e) {
        }

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->merchant_id,
                'Amount' => $price,
                'CallbackURL' => $CallbackURL,
                'Description' => 'پنل مدیریت',
            ]
        );

        return $result;

    }

    public function GetResultRequest($Authority, $price)
    {

        $data = array('MerchantID' => $this->merchant_id, 'Authority' => $Authority, 'Amount' => $price);
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);


        return $result;
    }
}


