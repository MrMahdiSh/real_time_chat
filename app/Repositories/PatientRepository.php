<?php


namespace App\Repositories;


use App\Interfaces\IPatientRepository;
use App\Repositories\Product\OrderRepository;
use App\Status;
use App\TypeModelTransAction;
use Modules\Patient\Entities\Patient;
use Modules\Payment\Entities\TransAction;
use Modules\Wallet\Entities\Wallet;

class PatientRepository extends BaseRepository implements IPatientRepository
{

    protected $tansAction;
    protected $wallet;
    protected $orderRepository;

    public function __construct(Patient $patient, Wallet $wallet, TransActionGlobalRepository $tansAction)
    {
        $this->wallet = $wallet;
        $this->tansAction = $tansAction;
        parent::__construct($patient);

    }

    public function AddToWallet($user_id, $price)
    {
        $account = $this->wallet->where(['user_id' => $user_id])->first();
        if (isset($account)) {
            $price += (int)$account->price;
            $account->update(['price' => $price]);
        } else {
            $this->wallet->create([

                'user_id' => $user_id,
                'price' => $price
            ]);
        }
    }

    public function GetMyOrders($user_id)
    {
        return $this->orderRepository->GetUserOrders($user_id)->get();
    }

    public function MyWallet($user_id)
    {
        $item = $this->wallet->where('user_id', $user_id)->first();
        return isset($item->price) ? $item->price : 0;
    }


    public function SubToWallet($user_id, $price)
    {
        $account = $this->wallet->updateOrCreate(['user_id' => $user_id], ['user_id' => $user_id]);

        $temp = (int)$account->price - $price;

        return $account->update(['price' => (int)$temp]);
    }

    public function MyTransActions($user_id)
    {
        return $this->tansAction->GetAll($user_id, TypeModelTransAction::Patient);
    }

    public function MyComments($user_id)
    {
        $item = $this->model->with('ArticleComments', 'DoctorRates')->Find($user_id);

        return [
            'ArticleComments' => isset($item->ArticleComments) ? $item->ArticleComments : null,
            'DoctorRates' => isset($item->DoctorRates) ? $item->DoctorRates : null,
        ];

    }
}
