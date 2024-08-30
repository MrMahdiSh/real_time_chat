<?php


namespace App\Interfaces;


interface IPatientRepository
{

    public function AddToWallet($user_id, $price);

    public function SubToWallet($user_id, $price);

    public function MyWallet($user_id);

    public function MyTransActions($user_id);


    public function MyComments($user_id);
    public function GetMyOrders($user_id);

}
