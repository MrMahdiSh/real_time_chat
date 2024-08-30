<?php


namespace App\Interfaces;


interface ICardRepository
{

    public function RemoveBasket($user_id,$transaction=null);

    public function AddToBasket($user_id, $product_id, $count = 1);

    public function RemoveFromBasket($user_id, $product_id, $count = 1);

    public function GetBasket($user_id);


}
