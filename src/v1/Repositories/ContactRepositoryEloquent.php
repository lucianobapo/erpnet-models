<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Interfaces\ContactRepository;
use ErpNET\Models\v1\Entities\ContactEloquent;

/**
 * Class ContactRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class ContactRepositoryEloquent extends BaseRepositoryEloquent implements ContactRepository
{
    protected $modelClass = ContactEloquent::class;
}
