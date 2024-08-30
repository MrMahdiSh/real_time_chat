<?php


namespace App\Interfaces;


use App\PaymentType;
use App\TypeModelTransAction;

interface IPaymentRepository
{

    public function ZarinPalPayment($user_id, $price, $order_id, $title, $ModelType, $type);

    public function CheckPaymentResult($TransAction);


}
