<?php


namespace App\Repositories;


use App\Helper\ZarinPal;
use App\Interfaces\IDoctorReservedOrderRepository;
use App\Interfaces\IPatientRepository;
use App\Interfaces\IPaymentRepository;
use App\Status;
use App\TypeModelTransAction;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Entities\DoctorReserved;
use Modules\Patient\Entities\Patient;
use Modules\Payment\Entities\TransAction;
use Modules\Wallet\Entities\Wallet;

class DoctorReservedOrderRepository extends BaseRepository implements IDoctorReservedOrderRepository
{

    protected $DoctorReservedOrder;

    public function __construct(DoctorReserved $DoctorReservedOrder)
    {
        $this->DoctorReservedOrder = $DoctorReservedOrder;
        parent::__construct($DoctorReservedOrder);
    }


    public function UpdateOrderStatusById($id, $Status = Status::Success)
    {

        $item = $this->DoctorReservedOrder->find($id);
        if (isset($item))
            $item->update(['status' => $Status]);

    }
}
