<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\ContactRepository;
use ErpNET\Models\v1\Validators\AddressValidator;

/**
 *  Contact resource representation.
 *
 * @Resource("Contact", uri="/contact")
 */
class ContactController extends ResourceController
{
    protected $routeName = 'contact';
    protected $repositoryClass = ContactRepository::class;
//    protected $validatorClass = AddressValidator::class;

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
