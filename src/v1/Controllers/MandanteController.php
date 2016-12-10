<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\MandanteRepository;
use ErpNET\Models\v1\Validators\MandanteValidator;

/**
 * Mandante resource representation.
 *
 * @Resource("Mandante", uri="/mandante")
 */
class MandanteController extends ResourceController
{
    protected $routeName = 'mandante';
    protected $repositoryClass = MandanteRepository::class;
    protected $validatorClass = MandanteValidator::class;

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
        return ['mandante'];
    }
}
