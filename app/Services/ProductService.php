<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Product\ProductRepositoryInterface;

class ProductService implements ServiceInterface
{
    use BaseService;

    public function __construct(protected ProductRepositoryInterface $repository)
    {}
}
