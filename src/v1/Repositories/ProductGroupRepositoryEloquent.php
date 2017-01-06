<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\ProductGroupRepository;
use ErpNET\Models\v1\Entities\ProductGroupEloquent;

/**
 * Class ProductGroupRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class ProductGroupRepositoryEloquent extends BaseRepositoryEloquent implements ProductGroupRepository
{
    protected $modelClass = ProductGroupEloquent::class;

}
