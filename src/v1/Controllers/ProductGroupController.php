<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Criteria\ProductGroupCategoriesCriteria;
use ErpNET\Models\v1\Criteria\ProductGroupActivatedCriteria;
use ErpNET\Models\v1\Interfaces\ProductGroupRepository;

class ProductGroupController extends ResourceController
{
    protected $routeName = 'product_group';
    protected $repositoryClass = ProductGroupRepository::class;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
        ProductGroupCategoriesCriteria::class,
        ProductGroupActivatedCriteria::class,
    ];
}
