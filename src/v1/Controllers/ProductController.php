<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Criteria\ProductActiveCriteria;
use ErpNET\Models\v1\Interfaces\ProductRepository;
use ErpNET\Models\v1\Validators\ProductValidator;

class ProductController extends ResourceController
{
    protected $routeName = 'product';
    protected $repositoryClass = ProductRepository::class;
    protected $validatorClass = ProductValidator::class;

    protected $paginateItemCount = -1;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
        ProductActiveCriteria::class,
    ];

}
