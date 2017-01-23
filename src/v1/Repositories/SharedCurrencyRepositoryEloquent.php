<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\SharedCurrencyRepository;
use ErpNET\Models\v1\Entities\SharedCurrencyEloquent;

/**
 * Class SharedCurrencyRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class SharedCurrencyRepositoryEloquent extends BaseRepositoryEloquent implements SharedCurrencyRepository
{
    protected $modelClass = SharedCurrencyEloquent::class;

}
