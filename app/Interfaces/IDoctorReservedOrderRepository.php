<?php


namespace App\Interfaces;


use App\Status;

interface IDoctorReservedOrderRepository
{

    public function UpdateOrderStatusById($id, $Status = Status::Success);



}
