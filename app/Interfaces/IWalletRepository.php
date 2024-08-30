<?php


namespace App\Interfaces;


interface IWalletRepository
{

    public function PayReservedWithWallet($user_id, $reserve_id);

    public function PayProductWithWallet($user_id, $price, $order_id);

    public function PayFactorWithWallet($user_id, $factor_id);

}
