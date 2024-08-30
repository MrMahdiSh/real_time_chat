<?php


namespace App\Repositories;


use App\Interfaces\IPatientRepository;
use App\Interfaces\ITransActionGlobalRepository;
use App\PaymentType;
use App\Status;
use App\TypeModelTransAction;
use Modules\Patient\Entities\Patient;
use Modules\Payment\Entities\TransAction;


class TransActionGlobalRepository implements ITransActionGlobalRepository
{

    protected $tansAction;

    public function __construct(TransAction $tansAction)
    {
        $this->tansAction = $tansAction;
    }

    public function create($data)
    {
        return $this->tansAction->create($data);
    }

    public
    function GetAll($user_id, $typeModel = TypeModelTransAction::Patient)
    {
        return $this->tansAction->where(['user_id' => $user_id, 'type_model' => $typeModel])->orderBy('id', 'desc')->get();
    }

    public function UpdateByNumberForPayment($number, $transAction, $status = Status::True)
    {
        $this->tansAction->updateOrCreate(['number' => $number], ['number' => $transAction, 'status' => $status]);
    }

    public function FindByNumber($transAction)
    {
        $item = $this->tansAction->where(['number' => $transAction, 'status' => Status::False])->first();


        return isset($item) ? $item : Status::False;
    }


    public function Add($user_id, $price, $order_id, $trans_action, $title, $typeModel, $status, $type)
    {
        TransAction::create([
            'user_id' => $user_id,
            'type' => $type,
            'number' => $trans_action == null ? rand(111111, 999999) : $trans_action,
            'price' => $price,
            'status' => $status,
            'order_id' => $order_id,
            'title' => $title,
            'type_model' => $typeModel,
        ]);
    }


}
