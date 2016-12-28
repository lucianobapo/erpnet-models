<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\SessionRepository;
use ErpNET\Models\v1\Validators\SessionValidator;

/**
 * Session resource representation.
 *
 * @Resource("Session", uri="/session")
 */
class SessionController extends ResourceController
{
    protected $routeName = 'session';
    protected $repositoryClass = SessionRepository::class;
//    protected $validatorClass = SessionValidator::class;

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
