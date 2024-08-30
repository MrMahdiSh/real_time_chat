<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use App\Interfaces\IProfitAdminRepository;
use App\Status;
use App\TypeModelTransAction;
use Modules\Article\Entities\Article;
use Modules\Page\Entities\Page;
use Modules\Product\Entities\ProductSetting;
use Modules\Setting\Entities\Setting;

class ProfitAdminRepository implements IProfitAdminRepository
{

    protected $transAction;
    protected $setting;

    public function __construct(TransActionGlobalRepository $transAction, Setting $setting)
    {
        $this->transAction = $transAction;
        $this->setting = $setting;

    }


    public function GetSettingProfit()
    {
        $item = $this->setting->first();
        return $item->percent_financial ? $item->percent_financial : 0;
    }

    public function AdminProfit($price, $payment_type)
    {
        $admin_profit = $this->GetSettingProfit();
        $admin_price_profit = ($price / 100) * $admin_profit;
        $admin_transaction = [
            'user_id' => 1,
            'type' => $payment_type,
            'number' => rand(111111, 9999990),
            'price' => $admin_price_profit,
            'status' => Status::True,
            'title' => 'درصد سود دریافتی',
            'order_id' => '0',
            'type_model' => TypeModelTransAction::Admin,
        ];
        $this->transAction->create($admin_transaction);
    }

    public function DoctorProfit($doctor_id, $price, $payment_type)
    {
        $admin_profit = $this->GetSettingProfit();

        $admin_price_profit = ($price / 100) * $admin_profit;
        $doctor_price_profit = $price - $admin_price_profit;
        $doctor_transaction = [
            'user_id' => $doctor_id,
            'type' => $payment_type,
            'number' => rand(111111, 9999990),
            'price' => $doctor_price_profit,
            'status' => Status::True,
            'title' => 'درصد سود دریافتی',
            'order_id' => '0',
            'type_model' => TypeModelTransAction::Doctor,
        ];

        return $this->transAction->create($doctor_transaction);

    }
}
