<?php


namespace App\Repositories\Product;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Product\Entities\CertificatePharmacy;
use Modules\Product\Entities\Pharmacy;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductBrand;

class CertificatePharmacyRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(CertificatePharmacy $model)
    {
        parent::__construct($model);
    }

}
