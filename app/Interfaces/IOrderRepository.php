<?php


namespace App\Interfaces;


use App\OrderStatus;
use App\Status;

interface IOrderRepository
{

    public function AddOrder($user_id, $detail_user);

    public function UpdateOrder($order_id, $status);

    public function GetAllOrder();


}
