<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\ItemOrderRepository;

class ItemOrderController extends ResourceController
{
    protected $routeName = 'item_order';
    protected $repositoryClass = ItemOrderRepository::class;

}
