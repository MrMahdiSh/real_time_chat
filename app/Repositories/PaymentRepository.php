<?php


namespace App\Repositories;


use App\Helper\ZarinPal;
use App\Interfaces\IPatientRepository;
use App\Interfaces\IPaymentRepository;
use App\OrderStatus;
use App\PaymentType;
use App\Repositories\Product\CardRepository;
use App\Repositories\Product\OrderRepository;
use App\Repositories\Service\ServiceReserveRepository;
use App\Status;
use App\TypeModelTransAction;
use Modules\Doctor\Entities\DoctorReserved;
use Modules\Patient\Entities\Patient;
use Modules\Payment\Entities\TransAction;
use Modules\Wallet\Entities\Wallet;

class PaymentRepository implements IPaymentRepository
{

    protected $tansAction;
    protected $wallet;
    protected $order;
    protected $patient;
    protected $ZarinPal;
    protected $orderRepository;
    protected $card;
    protected $profitAdminRepository;
    protected $serviceReserveRepository;

    public function __construct(ServiceReserveRepository $serviceReserveRepository, Wallet $wallet, TransActionGlobalRepository $tansAction,
                                DoctorReservedOrderRepository $order,
                                PatientRepository $patient, ZarinPal $ZarinPal, OrderRepository $orderRepository, ProfitAdminRepository $profitAdminRepository, CardRepository $card)
    {
        $this->wallet = $wallet;
        $this->tansAction = $tansAction;
        $this->order = $order;
        $this->patient = $patient;
        $this->ZarinPal = $ZarinPal;
        $this->orderRepository = $orderRepository;
        $this->card = $card;
        $this->profitAdminRepository = $profitAdminRepository;
        $this->serviceReserveRepository = $serviceReserveRepository;
    }

    #Payment
    public function ZarinPalPayment($user_id, $price, $order_id, $title, $ModelType, $type)
    {
        $result = $this->ZarinPal->SendRequest($price, route('result.payment'));
        if ($result->Status == 100) {
            $trans_action = $result->Authority;
            //$user_id, $price, $order_id, $trans_action, $title, $typeModel, $status, $type
            $this->tansAction->Add($user_id, $price, $order_id, $trans_action, $title, $ModelType, Status::False, $type);
            return 'https://www.zarinpal.com/pg/StartPay/' . $result->Authority;
        }
        return Status::False;
    }


    #Result
    public function CheckPaymentResult($TransAction)
    {
        $trans_action = $this->tansAction->FindByNumber($TransAction);


        if ($trans_action == Status::False)
            return Status::False;


        $result = $this->ZarinPal->GetResultRequest($TransAction, $trans_action->price);
        $realTransActionNumber = $result['RefID'];
        $realTransActionNumber = "test"; //For Offline Test
        if (isset($realTransActionNumber)) {
            $this->tansAction->UpdateByNumberForPayment($TransAction, $realTransActionNumber, Status::True);
            $this->profitAdminRepository->AdminProfit($trans_action->price, $trans_action->type);

            switch ($trans_action->type) {
                case (PaymentType::ADDWallet):
                    $this->patient->AddToWallet($trans_action->user_id, $trans_action->price);
                    break;
                case (PaymentType::ADDFactor):
                    // $this->profitAdminRepository->DoctorProfit($doc_id, $trans_action->price, $trans_action->type);
                    //ADDFactor Operation
                    break;
                case (PaymentType::ADDProduct):
                    $this->orderRepository->UpdateOrder($trans_action->order_id, OrderStatus::Paid);
                    $this->card->RemoveBasket($trans_action->user_id, $trans_action);
                    break;
                case (PaymentType::ADDService):
                    $this->serviceReserveRepository->UpdateOrder($trans_action->order_id, OrderStatus::Paid);
                    break;
                default :
                    $doctor = $this->order->getById($trans_action->order_id);
                    $doc_id = $doctor->user_id;
                    $this->profitAdminRepository->DoctorProfit($doc_id, $trans_action->price, $trans_action->type);
                    $this->order->UpdateOrderStatusById($trans_action->order_id);
                    break;
            }
            return Status::True;
        } else {
            return Status::False;
        }
    }
}
