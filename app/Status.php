<?php


namespace App;


use MyCLabs\Enum\Enum;

final class Status extends Enum
{
    const True = '1';
    const False = '0';
    const Success = 'success';
    const Error = 'error';
    const Reserve = 'reserve';

}
