<?php

namespace App\Services\Sales\Contracts;

interface SaleServiceContract
{
    public function get(): array;

    public function create(array $params): array;
}
