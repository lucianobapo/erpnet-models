<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\PageRepository;
use ErpNET\Models\v1\Validators\PageValidator;

/**
 * Post resource representation.
 *
 * @Resource("Page", uri="/page")
 */
class PageController extends ResourceController
{
    protected $routeName = 'page';
    protected $repositoryClass = PageRepository::class;
    protected $validatorClass = PageValidator::class;

    /**
     * @var integer
     */
    protected $paginateItemCount = 3;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
//        OpenOrdersCriteria::class,
    ];

    /**
     * ErpnetWidgetService fields configuration
     * @return array
     */
    protected function widgetServiceFields()
    {
        return [
            'rota',
            'nome',
            'h1',
            'h2',
            'view',
            'conteudo',
        ];
    }
}
