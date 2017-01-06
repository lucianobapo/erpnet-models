<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\ProductGroupRepository;

class ProductGroupController extends ResourceController
{
    protected $routeName = 'product-group';
    protected $repositoryClass = ProductGroupRepository::class;

}
