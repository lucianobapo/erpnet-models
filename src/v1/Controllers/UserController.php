<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\UserRepository;
use ErpNET\Models\v1\Validators\UserValidator;

/**
 * User resource representation.
 *
 * @Resource("User", uri="/user")
 */
class UserController extends ResourceController
{
    protected $routeName = 'user';
    protected $repositoryClass = UserRepository::class;
    protected $validatorClass = UserValidator::class;

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
