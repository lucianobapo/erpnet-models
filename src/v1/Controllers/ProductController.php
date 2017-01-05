<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\ProductRepository;
use ErpNET\Models\v1\Validators\PartnerValidator;

class ProductController extends ResourceController
{
    protected $routeName = 'product';
    protected $repositoryClass = ProductRepository::class;
//    protected $validatorClass = ProductValidator::class;

}
