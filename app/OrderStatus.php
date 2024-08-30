<?php


namespace App;


use MyCLabs\Enum\Enum;

final class OrderStatus extends Enum
{
    const Unpaid = 'Unpaid';
    const Paid = 'Paid';
    const Delivered = 'Delivered';
}
