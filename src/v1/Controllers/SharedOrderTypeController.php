<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\SharedOrderTypeRepository;

class SharedOrderTypeController extends ResourceController
{
    protected $routeName = 'shared_order_type';
    protected $repositoryClass = SharedOrderTypeRepository::class;

}
