<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\ProviderRepository;

/**
 *  Provider resource representation.
 *
 * @Resource("Provider", uri="/provider")
 */
class ProviderController extends ResourceController
{
    protected $routeName = 'provider';
    protected $repositoryClass = ProviderRepository::class;

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
