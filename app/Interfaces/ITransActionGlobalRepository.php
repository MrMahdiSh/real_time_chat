<?php


namespace App\Interfaces;


use App\PaymentType;
use App\Status;
use App\TypeModelTransAction;

interface ITransActionGlobalRepository
{


    public function Add($user_id, $price, $order_id, $trans_action, $title, $typeModel, $status, $type);

    public function create( $data);

    public function UpdateByNumberForPayment($number, $transAction, $status = Status::True);

    public function FindByNumber($transAction);


    public function GetAll($user_id, $typeModel);


}
