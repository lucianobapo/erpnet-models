<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\ProviderRepository;
use ErpNET\Models\v1\Entities\ProviderEloquent;

/**
 * Class ProviderRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class ProviderRepositoryEloquent extends BaseRepositoryEloquent implements ProviderRepository
{
    protected $modelClass = ProviderEloquent::class;

    protected $fieldSearchable = [
        'provider',
        'provider_id',
    ];
}
