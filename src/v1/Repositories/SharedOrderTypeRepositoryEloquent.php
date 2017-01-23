<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\SharedOrderTypeRepository;
use ErpNET\Models\v1\Entities\SharedOrderTypeEloquent;

/**
 * Class SharedOrderTypeRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class SharedOrderTypeRepositoryEloquent extends BaseRepositoryEloquent implements SharedOrderTypeRepository
{
    protected $modelClass = SharedOrderTypeEloquent::class;

}
