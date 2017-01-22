<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\AddressRepository;

/**
 *  Address resource representation.
 *
 * @Resource("Address", uri="/address")
 */
class AddressController extends ResourceController
{
    protected $routeName = 'address';
    protected $repositoryClass = AddressRepository::class;

    /**
     * @var integer
     */
    protected $paginateItemCount = 3;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [];

}
