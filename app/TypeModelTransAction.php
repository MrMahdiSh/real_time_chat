<?php


namespace App;


use MyCLabs\Enum\Enum;

final class TypeModelTransAction extends Enum
{
    const Patient = 'patient';
    const Doctor = 'doctor';
    const Admin = 'admin';
}
