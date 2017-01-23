<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\SharedOrderPaymentRepository;
use ErpNET\Models\v1\Entities\SharedOrderPaymentEloquent;

/**
 * Class SharedOrderPaymentRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class SharedOrderPaymentRepositoryEloquent extends BaseRepositoryEloquent implements SharedOrderPaymentRepository
{
    protected $modelClass = SharedOrderPaymentEloquent::class;

}
