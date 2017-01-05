<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\ProductRepository;
use ErpNET\Models\v1\Entities\ProductEloquent;
use ErpNET\Models\v1\Presenters\ProductPresenter;

/**
 * Class ProductRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepositoryEloquent implements ProductRepository
{
    protected $modelClass = ProductEloquent::class;
    protected $presenterClass = ProductPresenter::class;

}
