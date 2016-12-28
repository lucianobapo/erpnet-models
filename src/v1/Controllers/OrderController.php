<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Criteria\OpenOrdersCriteria;
use ErpNET\Models\v1\Interfaces\OrderRepository;
use ErpNET\Models\v1\Validators\OrderValidator;

/**
 * Mandante resource representation.
 *
 * @Resource("Order", uri="/order")
 */
class OrderController extends ResourceController
{
    protected $routeName = 'order';
    protected $repositoryClass = OrderRepository::class;
    protected $validatorClass = OrderValidator::class;

    /**
     * @var integer
     */
    protected $paginateItemCount = 3;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
        OpenOrdersCriteria::class,
    ];
}
