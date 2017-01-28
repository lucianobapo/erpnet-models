<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\ItemOrderRepository;
use ErpNET\Models\v1\Entities\ItemOrderEloquent;

/**
 * Class ItemOrderRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class ItemOrderRepositoryEloquent extends BaseRepositoryEloquent implements ItemOrderRepository
{
    protected $modelClass = ItemOrderEloquent::class;

}
