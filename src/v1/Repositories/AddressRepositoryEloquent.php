<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\AddressRepository;
use ErpNET\Models\v1\Entities\AddressEloquent;

/**
 * Class AddressRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class AddressRepositoryEloquent extends BaseRepositoryEloquent implements AddressRepository
{
    protected $modelClass = AddressEloquent::class;
}
