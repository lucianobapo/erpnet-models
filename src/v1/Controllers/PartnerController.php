<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\PartnerRepository;
use ErpNET\Models\v1\Validators\PartnerValidator;

class PartnerController extends ResourceController
{
    protected $routeName = 'partner';
    protected $repositoryClass = PartnerRepository::class;
    protected $validatorClass = PartnerValidator::class;

}
