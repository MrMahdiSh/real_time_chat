<?php


namespace App;


use MyCLabs\Enum\Enum;

final class PaymentType extends Enum
{
    const ADDWallet = 'ADDWallet';
    const SUBWallet = 'SUBWallet';
    const ADDPayment = 'ADDPayment';
    const SUBPayment = 'SUBPayment';

    const ADDFactor = 'ADDPayment';
    const SUBFactor = 'SUBPayment';


    const ADDProduct = 'ADDProduct';
    const SUBProduct = 'SUBProduct';


    const ADDService = 'ADDService';
    const SUBService = 'SUBService';
}
