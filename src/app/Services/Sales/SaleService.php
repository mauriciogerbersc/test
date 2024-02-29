<?php

namespace App\Services\Sales;

use App\Models\SaleItems;
use App\Repositories\Products\Contracts\ProductRepositoryContract;
use App\Services\Sales\Contracts\SaleServiceContract;
use App\Repositories\Sales\Contracts\SaleRepositoryContract;
use App\Repositories\SaleItems\Contracts\SaleItemsRepositoryContract;

class SaleService implements SaleServiceContract
{
    /**
     * @var SaleRepositoryContract $saleRepository
     */
    private $saleRepository;

    /**
     * @param SaleRepositoryContract $saleRepository
     */
    private $productRepository;

    /**
    * @param SaleItemsRepositoryContract $saleItemRepository
    */
    private $saleItemRepository;

    /**
     * @param ProductRepositoryContract $productRepository
     * @param SaleRepositoryContract $saleRepository
     * @param SaleItemsRepositoryContract $saleItemRepository
     */
    public function __construct(
        ProductRepositoryContract $productRepository,
        SaleRepositoryContract $saleRepository,
        SaleItemsRepositoryContract $saleItemRepository)
    {
        $this->saleRepository = $saleRepository;
        $this->productRepository = $productRepository;
        $this->saleItemRepository = $saleItemRepository;
    }

    /**     * @return array
     */
    public function get(): array
    {
        return $this->saleRepository->getWithRelation('products')->toArray();
    }

    /**
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        $amount = $this->sumProductAmount($params);

        $sale = $this->saleRepository->store(['amount' => $amount])->toArray();

        $this->saleItems($params, $sale['sale_id']);

        return $sale;
    }

    /**
     * @param array $params
     * @return integer
     */
    private function sumProductAmount(array $params): int
    {
        $amount = 0;

        foreach ($params as $key => $val) {
            $amount += $this->productRepository->getById($val['product_id'])['price'];
        }

        return $amount;
    }

    /**
     * @param array $params
     * @param string $sale_id
     * @return void
     */
    private function saleItems(array $params, string $sale_id): void
    {
        foreach ($params as $key => $val) {
            $this->saleItemRepository->store([
                'product_id' => $val['product_id'],
                'sale_id' => $sale_id
            ]);
        }
    }
}