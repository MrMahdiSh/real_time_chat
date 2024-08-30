<?php


namespace App\Interfaces;


use App\OrderStatus;
use App\Status;

interface IProfitAdminRepository
{


    public function GetSettingProfit();

    public function AdminProfit($price, $payment_type);

    public function DoctorProfit($doctor_id, $price, $payment_type);


}
