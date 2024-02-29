<?php

namespace App\Repositories\Sales;

use App\Models\Sales;
use App\Repositories\BaseRepository;
use App\Repositories\Sales\Contracts\SaleRepositoryContract;

class SaleRepository extends BaseRepository implements SaleRepositoryContract
{
    /**
     * @var Sales $Smodel
     */
    protected $model;

    /**
     * @param Sales $sales
     */
    public function __construct(Sales $sales)
    {
        $this->model = $sales;
    }
}
