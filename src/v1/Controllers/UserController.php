<?php

namespace ErpNET\Models\v1\Controllers;

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

    /**
     * ErpnetWidgetService fields configuration
     * @return array
     */
    protected function widgetServiceFields()
    {
        return [
            'mandante',
            'name',
            'provider',
            'provider_id',
        ];
    }
}
