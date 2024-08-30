<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use App\Interfaces\IWalletRepository;
use App\OrderStatus;
use App\PaymentType;
use App\Repositories\Product\CardRepository;
use App\Repositories\Product\OrderRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Service\ServiceReserveRepository;
use App\Status;
use App\TypeModelTransAction;
use Modules\Article\Entities\Article;
use Modules\Doctor\Entities\Doctor;
use Modules\Page\Entities\Page;
use Modules\Product\Entities\OrderProduct;
use Modules\Setting\Entities\Setting;
use Modules\Wallet\Entities\Wallet;
use PhpParser\Comment\Doc;

class WalletRepository extends BaseRepository implements IWalletRepository
{

    protected $transAction;
    protected $wallet;
    protected $doctorReservedOrder;
    protected $orderRepository;
    protected $patient;
    protected $card;
    protected $profitAdminRepository;
    protected $serviceReserveRepository;


    public function __construct(ServiceReserveRepository $serviceReserveRepository, Wallet $wallet, TransActionGlobalRepository $transAction,
                                DoctorReservedOrderRepository $doctorReservedOrder, CardRepository $card,
                                OrderRepository $orderRepository, PatientRepository $patient, ProfitAdminRepository $profitAdminRepository)
    {
        $this->transAction = $transAction;
        $this->wallet = $wallet;
        $this->doctorReservedOrder = $doctorReservedOrder;
        $this->orderRepository = $orderRepository;
        $this->patient = $patient;
        $this->card = $card;
        $this->profitAdminRepository = $profitAdminRepository;
        $this->serviceReserveRepository = $serviceReserveRepository;

        parent::__construct($wallet);
    }


    public function PayReservedWithWallet($user_id, $reserve_id)
    {
        //                    $this->profitAdminRepository->DoctorProfit($doc_id, $trans_action->price, $trans_action->type);
        $reserve = $this->doctorReservedOrder->getById($reserve_id);
        $this->patient->SubToWallet($user_id, (int)$reserve->price);
        $this->transAction->Add($user_id, (int)$reserve->price, $reserve_id, rand(1111, 9999), "پرداخت  کیف پول", TypeModelTransAction::Patient, Status::True, PaymentType::SUBWallet);
        $this->doctorReservedOrder->UpdateOrderStatusById($reserve_id, Status::Success);
        $this->profitAdminRepository->DoctorProfit($reserve->user_id, (int)$reserve->price, PaymentType::ADDPayment);

        return true;
    }

    public function PayServiceReservedWithWallet($user_id, $reserve_id)
    {

        $reserve = $this->serviceReserveRepository->getById($reserve_id);
        $this->patient->SubToWallet($user_id, (int)$reserve->price);
        $this->transAction->Add($user_id, (int)$reserve->price, $reserve_id, rand(1111, 9999), "پرداخت  کیف پول", TypeModelTransAction::Patient, Status::True, PaymentType::SUBWallet);
        $this->serviceReserveRepository->UpdateOrder($reserve_id, OrderStatus::Paid);
        $this->profitAdminRepository->DoctorProfit($reserve->doctor->id, (int)$reserve->price, PaymentType::ADDPayment);

        return true;
    }

    public function PayProductWithWallet($user_id, $price, $order_id)
    {
        $rand = rand(1111111, 9999999);
        $this->transAction->Add($user_id, (int)$price, $order_id, $rand, "پرداخت  کیف پول", TypeModelTransAction::Patient, Status::True, PaymentType::SUBWallet);
        $this->patient->SubToWallet($user_id, $price);
        $this->orderRepository->UpdateOrder($order_id, OrderStatus::Paid);
        $transaction = $this->transAction->FindByNumber($rand);
        $this->card->RemoveBasket($user_id, $transaction);
        return true;
    }

    public function PayFactorWithWallet($user_id, $factor_id)
    {
        // TODO: Implement PayFactorWithWallet() method.
    }
}
