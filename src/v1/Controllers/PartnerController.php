<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\PartnerRepository;
use ErpNET\Models\v1\Validators\PartnerValidator;
use ErpNET\Models\v1\Criteria\PartnerActiveCriteria;

class PartnerController extends ResourceController
{
    protected $routeName = 'partner';
    protected $repositoryClass = PartnerRepository::class;
    protected $validatorClass = PartnerValidator::class;
    
    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
        PartnerActiveCriteria::class,
    ];
}
